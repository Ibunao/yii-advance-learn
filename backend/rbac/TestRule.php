<?php
namespace backend\rbac;

use yii\rbac\Rule;

/**
 * 创建规则，相对于路由(权限)的权限更加细分
 * 如果该用户不满足某个路由(权限)，但是满足规则依旧可以访问
 * 检查 authorID 是否和通过参数传进来的 user 参数相符
 */
class TestRule extends Rule
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
         *  route:http://admin.yiilearn.com/goods/view?id=10
{
    "user": 2,
    "item": {
        "type": "2",
        "name": "权限3",
        "description": "用来测试的",
        "ruleName": "backend\\rbac\\TestRule",
        "data": {
            "ding": "ran"
        },
        "createdAt": "1536826796",
        "updatedAt": "1536826796"
    },
    "params": {
        "id": "10"
    }
}
         */
        echo json_encode(['user' => $user, 'item' => $item, 'params' => $params]);exit;
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}