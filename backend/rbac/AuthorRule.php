<?php
namespace backend\rbac;

use yii\rbac\Rule;

/**
 * 创建规则，相对于路由(权限)的权限更加细分
 * 如果该用户满足某个路由(权限)，但是满足规则依旧不可以访问
 */
class AuthorRule extends Rule
{
    // 规则名
    public $name = 'isAuthor';

    /**
     * @param string|integer $user 用户 ID.
     * @param Item $item 该规则相关的角色或者权限
     * @param array $params get参数
     * @return boolean 代表该规则相关的角色或者权限是否被允许
     */
    public function execute($user, $item, $params)
    {
        /**
         *  route:http://admin.yiilearn.com/test/index3?id=10
{
    "user": 2,
    "item": {
        "type": "2",
        "name": "updateOwnPost",
        "description": "更新自己的",
        "ruleName": "isAuthor",
        "data": {
            "abc": "cba"
        },
        "createdAt": "1539229574",
        "updatedAt": "1539229574"
    },
    "params": {
        "id": "10"
    }
}
         */
        echo json_encode(['user' => $user, 'item' => $item, 'params' => $params]);exit;
        return false;
    }
}