<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo e(config('settings.website_name_ar')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700" rel="stylesheet">
</head>
<body style="margin: 0; padding-top: 30px; background-color: #f5f8fb; direction: rtl;">
<table  align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse">
    <tr>
        <td>
            <table width="100%" align="center" style="border-collapse: collapse; background-color: #fff;font-family: 'Cairo', sans-serif; ">
                <tr>
                    <td style=" padding: 25px 25px 0 25px; vertical-align: middle;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="center" style="vertical-align: top;">
                                    <a href="#" style="text-decoration: none; display: inline-block;">
                                        <img src="<?php echo e(url('assets')); ?>/logo.png" style="width:70px">
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 25px;">
                        <table cellpadding="0" cellspacing="0" width="100%">

                            <?php echo $__env->yieldContent('content'); ?>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <p style="color: #2e2e2e; font-size: 13px;"><?php echo e(config('settings.website_name')); ?></p>
        </td>
    </tr>
</table>

</body>
</html>