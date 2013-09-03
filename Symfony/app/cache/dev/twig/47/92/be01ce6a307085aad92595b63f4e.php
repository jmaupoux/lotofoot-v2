<?php

/* Lotofootv2Bundle::layout.html.twig */
class __TwigTemplate_4792be01ce6a307085aad92595b63f4e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'menu' => array($this, 'block_menu'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\"/>

        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <script type=\"text/javascript\" src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/js/lib/jquery-1.8.1.min.js"), "html", null, true);
        echo "\"></script>
\t\t<script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/js/lib/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
\t\t<script type=\"text/javascript\">
\t\t\tjQuery.noConflict();
\t\t</script>
\t\t

\t    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/css/bootstrap.min.css"), "html", null, true);
        echo "\" />
\t    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/css/bootstrap-responsive.min.css"), "html", null, true);
        echo "\" />
    </head>
    <body>
    \t";
        // line 18
        $this->displayBlock('menu', $context, $blocks);
        // line 20
        echo "    
        <div id=\"content\">
\t\t\t";
        // line 22
        $this->displayBlock('body', $context, $blocks);
        // line 25
        echo "\t\t</div>
\t</body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
    }

    // line 18
    public function block_menu($context, array $blocks = array())
    {
        // line 19
        echo "\t\t";
    }

    // line 22
    public function block_body($context, array $blocks = array())
    {
        // line 23
        echo "\t\t\t
\t\t\t";
    }

    public function getTemplateName()
    {
        return "Lotofootv2Bundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 23,  85 => 22,  81 => 19,  78 => 18,  73 => 6,  67 => 25,  65 => 22,  61 => 20,  59 => 18,  53 => 15,  49 => 14,  40 => 8,  36 => 7,  27 => 4,  22 => 1,  41 => 9,  38 => 8,  32 => 6,  29 => 4,);
    }
}
