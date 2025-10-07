<?php
// 代码生成时间: 2025-10-07 21:20:37
// csrf_protection.php
// 这个文件提供了一个简单的CSRF防护机制的实现示例。

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;

class CsrfProtectionController extends Controller
{
    // 这个方法演示了如何在POST请求中验证CSRF令牌。
    public function actionIndex()
    {
        // 只有当请求方法是POST时，我们才需要验证CSRF令牌。
        if (Yii::$app->request->isPost) {
            // 验证CSRF令牌。如果验证失败，抛出异常。
            if (!Yii::$app->request->validateCsrfToken()) {
                throw new BadRequestHttpException('CSRF token validation failed.');
            }

            // CSRF令牌验证通过，可以继续处理请求。
            return 'CSRF token is valid.';
        }

        // 如果不是POST请求，返回一个CSRF令牌。
        return Yii::$app->request->getCsrfToken();
    }
}
