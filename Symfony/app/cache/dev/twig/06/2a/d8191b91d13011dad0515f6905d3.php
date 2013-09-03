<?php

/* Lotofootv2Bundle:User:home.html.twig */
class __TwigTemplate_062ad8191b91d13011dad0515f6905d3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("Lotofootv2Bundle::layout.html.twig");

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "Lotofootv2Bundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_menu($context, array $blocks = array())
    {
        // line 5
        echo "\t";
        $this->env->loadTemplate("Lotofootv2Bundle::menu.html.twig")->display($context);
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        // line 9
        echo "\tHello ";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo "!
";
    }

    public function getTemplateName()
    {
        return "Lotofootv2Bundle:User:home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 9,  37 => 8,  32 => 5,  29 => 4,);
    }
}
