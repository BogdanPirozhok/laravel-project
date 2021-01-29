<?php


namespace App\Repositories\BodyBuilder\Tools\Product;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class Warn extends AbstractBlock
{

    public function render($data)
    {
        return
            '<span class="recipe-article__note">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="11.5" stroke="#E74318"></circle>
                   <path d="M13.04 5L12.58 13.64L11.64 13.74L11.48 13.56L11.46 5.06L11.62 4.86L12.84 4.8L13.04 5ZM11.9 16.24C12.1667 16.24 12.3733 16.32 12.52 16.48C12.68 16.64 12.76 16.86 12.76 17.14C12.76 17.4333 12.6733 17.6667 12.5 17.84C12.34 18.0133 12.12 18.1 11.84 18.1C11.5467 18.1 11.32 18.02 11.16 17.86C11.0133 17.7 10.94 17.4733 10.94 17.18C10.94 16.9 11.0267 16.6733 11.2 16.5C11.3733 16.3267 11.6067 16.24 11.9 16.24Z" fill="#E74318"></path>
                </svg>' .
                'Мы не используем химических растворов для удаления костей'.
            '</span>';
    }

    public function getSignature()
    {
        return 'warn';
    }

    public function getAttributes()
    {
        return ['type', 'caption', 'value'];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
