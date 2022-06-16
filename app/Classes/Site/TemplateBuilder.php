<?php

namespace App\Classes\Site;

class TemplateBuilder
{
    var $name;

    public function setNormalTemplate($template)
    {
        $this->name = 'site.' . $template;
    }

    public function setSupportMain()
    {
        $this->name = 'site.support';
    }

    public function setSupportCategory()
    {
        $this->name = 'site.universal2.support_category';
    }

    public function setSupportAnswer()
    {
        $this->name = 'site.universal2.support_answer';
    }

    public function getName()
    {
        return $this->name;
    }
}
