<?php

/* Lotofootv2Bundle::menu.html.twig */
class __TwigTemplate_ae742f9e998e2fa76c565de74ab29c8c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"navbar\">
\t<div class=\"navbar-inner\">
\t\t<div class=\"container\" style=\"padding-left:20px;padding-right:20px\">
\t\t
\t\t\t<ul class=\"nav\">
\t\t\t\t<li style=\"width:30px\">
\t\t\t\t&nbsp;
\t\t\t\t</li>
\t\t\t\t<li class=\"big-icon\">
\t\t\t\t\t<a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("_home");
        echo "\">
\t\t\t\t\t\t<img src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/img/menu/home.png"), "html", null, true);
        echo "\"></img> <br/>
\t\t\t\t\t\tAccueil
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"divider-vertical\"></li>
\t\t\t</ul>
\t\t\t
\t\t\t
\t\t\t<ul class=\"nav nav pull-right\">
\t\t\t
\t\t\t\t";
        // line 21
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 22
            echo "\t\t\t\t<li class=\"divider-vertical\"></li>
\t\t\t\t<li class=\"dropdown big-icon\">
\t\t\t\t\t<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
\t\t\t\t\t\t<img src=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/lotofootv2/img/menu/admin.png"), "html", null, true);
            echo "\"/> <br/>
\t\t\t\t\t\tAdministration
\t\t\t\t\t\t<b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t\t\tentree1
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t\t\tentree1
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>

\t\t\t\t";
        }
        // line 44
        echo "\t\t\t\t
\t\t\t\t<li class=\"divider-vertical\"></li>
\t\t\t\t<li style=\"text-align:left\">
\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t<i class=\"icon-user\" ></i> Mon compte
\t\t\t\t\t</a>
\t\t\t\t\t<a href=\"";
        // line 50
        echo $this->env->getExtension('routing')->getPath("_logout");
        echo "\"><i class=\"icon-chevron-right\" ></i> Déconnexion </a>
\t\t\t\t</li>
\t\t\t\t
\t\t\t</ul>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "Lotofootv2Bundle::menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 50,  76 => 44,  54 => 25,  49 => 22,  47 => 21,  34 => 11,  30 => 10,  19 => 1,);
    }
}
