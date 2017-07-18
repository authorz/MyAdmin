<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2017/6/3
 * Time: 16:39
 */
namespace App\Http\Controllers\WebSite;

use App\Builder\Builder;
use App\Libarary\UrlFunc;


trait Builders
{
    public function indexBuilder(array $data, $field)
    {
        $list = Builder::forms();

        $view = function (array $data, $field) use ($list) {

            $list->setNav($data['siteClass'], 'id');

            $list->setSubWay('post')->setFormUrl(UrlFunc::jumpUrl('website/store'));

            foreach ($field as $key => $value) {
                $list->addFormItem(['name' => $value->Name, 'title' => $value->Title, 'type' => 'text', 'value' => $data['siteList'][$value->Name]->Value]);
            }
            return $list;
        };

        return $view($data, $field)->display();

    }
}