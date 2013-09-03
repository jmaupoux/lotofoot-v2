<?php

/* Lotofootv2Bundle::login.html.twig */
class __TwigTemplate_755559fbdb8bf9af59543cfbdd750aaf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("Lotofootv2Bundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "\tConnexion au Lotofoot v2 !
";
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        // line 9
        echo "\t<div style=\"padding-top:100px;margin:auto;width:550px\" class=\"well\">
\t\t
\t\t";
        // line 11
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 12
            echo "\t        <div class=\"error\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message"), "html", null, true);
            echo "</div>
\t    ";
        }
        // line 14
        echo "\t\t
\t\t<form action=\"";
        // line 15
        echo $this->env->getExtension('routing')->getPath("_login_check");
        echo "\" method=\"post\" class=\"form form-horizontal\">
\t\t\t<div class=\"control-group\">
\t\t\t\t<label class=\"control-label\" for=\"_username\">
\t\t\t\t\t Nom d'utilisateur <span style=\"color:red\"> * </span> 
\t\t\t\t</label>
\t\t\t\t<div class=\"controls\">
\t\t\t\t\t<div class=\"input-prepend\">
\t\t\t\t\t\t<span class=\"add-on\">
\t\t\t\t\t\t\t<i class=\"icon-user\"></i>
\t\t\t\t\t\t</span>
\t\t\t\t\t\t <input type=\"text\" id=\"_username\" name=\"_username\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" placeholder=\"Nom d'utilisateur\"/>
\t\t\t\t\t </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"control-group\">
\t\t\t\t<label class=\"control-label\" for=\"_username\">
\t\t\t\t\t Mot de passe <span style=\"color:red\"> * </span> 
\t\t\t\t</label>
\t\t\t\t<div class=\"controls\">
\t\t\t\t\t<div class=\"input-prepend\">
\t\t\t\t\t\t<span class=\"add-on\">
\t\t\t\t\t\t\t<i class=\"icon-lock\"></i>
\t\t\t\t\t\t</span>
\t\t\t\t\t\t <input type=\"text\" id=\"_password\" name=\"_password\"  placeholder=\"Mot de passe\"/>
\t\t\t\t\t </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t
\t\t    <input type=\"hidden\" name=\"_target_path\" value=\"/home\" />
\t\t\t
\t\t\t<div class=\"control-group\">
\t\t\t\t<div class=\"controls\">
\t\t\t\t\t<button type=\"submit\" class=\"btn\" value=\"\">Connexion</button>\t
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t</form>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "Lotofootv2Bundle::login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 25,  55 => 15,  52 => 14,  46 => 12,  44 => 11,  40 => 9,  37 => 8,  32 => 5,  29 => 4,);
    }
}
