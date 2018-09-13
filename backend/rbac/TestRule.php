<?php
namespace backend\rbac;

use yii\rbac\Rule;

/**
 * 创建规则，相对于权限更加细分
 * 如果该用户不满足某个权限，但是满足规则依旧可以访问
 * 检查 authorID 是否和通过参数传进来的 user 参数相符
 */
class TestRule extends Rule
{
    // 规则名
    public $name = 'isAuthor';

    /**
     * @param string|integer $user 用户 ID.
     * @param Item $item 该规则相关的角色或者权限
     * @param array $params 传给 ManagerInterface::checkAccess() 的参数
     * @return boolean 代表该规则相关的角色或者权限是否被允许
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}