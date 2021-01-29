<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *:before, *:after {
            outline: none !important;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        a, span, p, td {
            font-size: 16px;
            color: #323248;
        }

        span, p, td {
            cursor: default;
        }

        a {
            text-decoration: none;
        }

        .hr {
            height: 1px;
            background-color: #B7B7CD;
            display: block;
        }

        .td-colum--one {
            width: 156px;
            padding-right: 16px;
            vertical-align: top;
        }

        .td-colum--two {
            vertical-align: top;
        }

        @media screen and (max-width: 510px) {
            .td-colum--one {
                display: block;
                width: 100%;
                padding-right: 0;
                margin-bottom: 6px;
            }

            .td-colum--two {
                display: block;
                width: 100%;
            }
        }
    </style>

</head>
<body>
    <table bgcolor="#EFEFF4" border="0" cellpadding="0" cellspacing="0"
           style="margin: 0;padding: 50px 0; width: 100%;height: 100vh;">
        <tr>
            <td>
                <center style="max-width: 630px; width: 100%;margin: 0 auto;padding: 0 15px;">
                    <table border="0" cellpadding="0" cellspacing="0" style="margin: 0;padding: 16px; width: 100%;">
                        <tr>
                            <td style="text-align: center;">
                                <a href="https://delsy.itdecision-llc.com" style="display: inline-block;">
                                    <img src="{{ asset('library/img/logo.png') }}" alt="" style="max-height: 100%;object-fit: contain;">
                                </a>
                            </td>
                        </tr>
                    </table>

                    <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0"
                           style="margin: 0;padding: 24px 24px 24px 24px; width: 100%;">
                        <tr style="margin-bottom: 24px;display: block;">
                            <td style="text-align: center;display: block;">
                                <span style="font-weight: 500;">Контроль качества</span>
                            </td>
                        </tr>

                        <tr class="hr"></tr>
                    </table>


                    <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0"
                           style="margin: 0;padding: 0 24px; width: 100%;">

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">ФИО:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->contact_name }}</span>
                            </td>
                        </tr>

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Email / телефон:</span>
                            </td>
                            <td class="td-colum--two">
                                <a href="mailto:ivanovsp74@mail.ru" style="font-size: 14px;">{{ $model->contact_attribute }}</a>
                            </td>
                        </tr>
                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Дата покупки:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->purchase_date }}</span>
                            </td>
                        </tr>

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Название магазина:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->purchase_place_name }}</span>
                            </td>
                        </tr>

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Адрес магазина:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->purchase_place_address }}</span>
                            </td>
                        </tr>

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Дата производства:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->purchase_product_date }}</span>
                            </td>
                        </tr>

                        <tr style="display: block;margin-bottom: 24px;">
                            <td class="td-colum--one">
                                <span style="font-size: 14px;color: #8787AB;font-weight: 500;">Комментарий:</span>
                            </td>
                            <td class="td-colum--two">
                                <span style="font-size: 14px;">{{ $model->wishes }}</span>
                            </td>
                        </tr>

                        @if($model->barcode_file_path !== null)
                            <tr style="display: block;margin-bottom: 24px;">
                                <td class="td-colum--one">
                                <span
                                    style="font-size: 14px;color: #8787AB;font-weight: 500;">Прикрепленный файл:</span>
                                </td>

                                <td class="td-colum--two">
                                    <a href="{{$model -> barcode_file_path}}" download
                                       style="font-size: 14px;color: #5864C5;text-decoration: underline;"><img
                                            src="{{ asset('library/img/clip.png') }}" alt="" style="margin: 0 8px -1px 0;">{{ $model->barcode_file_name }}</a>
                                </td>
                            </tr>
                        @endif

                    </table>
                </center>
            </td>
        </tr>
    </table>
</body>
</html>
