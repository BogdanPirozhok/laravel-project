<?php


namespace App\Repositories\BodyBuilder;

use App\Repositories\BodyBuilder\Exceptions\BodyBuilderException;
use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class BodyBuilder
{
    public array $data = [];

    public array $tools = [];

    protected \HTMLPurifier $purifier;

    /**
     * BodyBuilder constructor.
     * @param array $data
     * @param array $tools
     * @throws BodyBuilderException
     */
    public function __construct(array $data, array $tools)
    {
        if (empty($data)) {
            throw new BodyBuilderException('Blocks is empty');
        }

        $this->data = $data;

        $this->addTools($tools);

        $this->validateBlocks();
    }

    /**
     * Do sanitize
     *
     * @return BodyBuilder
     * @throws BodyBuilderException
     */
    public function sanitize()
    {
        $this->sanitizeBlocks();

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $html = [];

        foreach ($this->data as $key => $block) {
            $html[] = $this->tools[$block['type']]->render($block);
        }

        return implode('', $html);
    }

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->data;
    }

    /**
     * @throws BodyBuilderException
     */
    protected function validateBlocks()
    {
        foreach ($this->data as $key => $block) {
            if (!isset($block['type'])) {
                throw new BodyBuilderException(
                    sprintf('Block doesnt have \'type\' attribute')
                );
            }

            $tool = $this->tools[$block['type']] ?? null;

            if (!$tool) {
                throw new BodyBuilderException(
                    sprintf('Block not found in tools')
                );
            }

            // check if tool attributes same as block keys
            $keyDiff = array_diff_key(array_flip($tool->getAttributes()), $block);
            if (count($keyDiff) > 0) {
                throw new BodyBuilderException(
                    sprintf('Attributes "%s" doesnt exists in requested block', implode(',', array_keys($keyDiff)))
                );
            }
        }

        return true;
    }

    /**
     * Sanitize inputs
     * @throws BodyBuilderException
     */
    protected function sanitizeBlocks(): void
    {
        foreach ($this->data as $index => &$block) {
            foreach ($block as $key => &$value) {
                $tool = $this->tools[$block['type']] ?? null;

                if (!$tool) {
                    throw new BodyBuilderException(
                        sprintf('Block "%s" not found in tools', $block['type'])
                    );
                }
                $value = $this->getPurifier()->purify($value, $tool->getPurifyRules());

                unset($tool);
            }
        }
    }

    /**
     * Get purifier instance
     *
     * @return \HTMLPurifier
     */
    protected function getPurifier(): \HTMLPurifier
    {
        if (!isset($this->purifier)) {
            $sanitizer = $this->getPurifierConfig();
            $this->purifier = new \HTMLPurifier($sanitizer);
        }
        return $this->purifier;
    }

    /**
     * @return \HTMLPurifier_Config
     */
    protected function getPurifierConfig(): \HTMLPurifier_Config
    {
        $sanitizer = \HTMLPurifier_Config::createDefault();

        $sanitizer->set('HTML.TargetBlank', true);
        $sanitizer->set('AutoFormat.RemoveEmpty', false);
        $sanitizer->set('HTML.AllowedElements', '');
        $sanitizer->set('AutoFormat.RemoveEmpty.RemoveNbsp', true); // remove empty, even if it contains an &nbsp;

        $cacheDirectory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'purifier';
        if (!is_dir($cacheDirectory)) {
            mkdir($cacheDirectory, 0777, true);
        }

        $sanitizer->set('Cache.SerializerPath', $cacheDirectory);

        return $sanitizer;
    }

    /**
     * @param array $tools
     * @throws BodyBuilderException
     */
    protected function addTools(array $tools)
    {
        foreach ($tools as $tool) {
            $this->addTool($tool);
        }
    }

    /**
     * @param $tool
     * @throws BodyBuilderException
     */
    protected function addTool($tool): void
    {
        $tool = $this->resolveTool($tool);

        if (array_key_exists($tool->getSignature(), $this->tools)) {
            throw new BodyBuilderException(
                sprintf(
                    'Signature "%s" already assigned in list of tools',
                    $tool->getSignature()
                ),
            );
        } else {
            $this->tools[$tool->getSignature()] = $tool;
        }
    }

    /**
     * @param $tool
     * @return AbstractBlock
     * @throws BodyBuilderException
     */
    protected function resolveTool($tool): AbstractBlock
    {
        $tool = $this->makeToolObj($tool);

        if (!($tool instanceof AbstractBlock)) {
            throw new BodyBuilderException(
            // todo: change error caption
                sprintf(
                    'Tool "%s" must be an instance of AbstractBlock',
                    get_class($tool)
                )
            );
        }

        return $tool;
    }

    /**
     * Return tool object
     *
     * @param $tool
     * @return mixed
     * @throws BodyBuilderException
     */
    protected function makeToolObj($tool)
    {
        if (is_object($tool)) {
            return $tool;
        }

        if (!class_exists($tool)) {
            throw new BodyBuilderException(sprintf('Tool block "%s" not found', $tool));
        }

        return new $tool;
    }

}
