<?php

/* installer/install.twig.html */
class __TwigTemplate_ac2465cb10fcc66a33b6373267aab588bf2d72dfb6ee066c7a9a366c49ab67a0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 9
        $this->parent = $this->loadTemplate("index.twig.html", "installer/install.twig.html", 9);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'sidebar' => array($this, 'block_sidebar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "index.twig.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    public function block_head($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->loadTemplate("head.twig.html", "installer/install.twig.html", 12)->displayBlock("meta", $context);
        echo "

    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"../favicon.ico\"/>
    <link rel='stylesheet' type='text/css' href='../resources/assets/css/theme.min.css' />
    <link rel='stylesheet' type='text/css' href='../resources/assets/css/core.min.css' />
    <link rel='stylesheet' type='text/css' href='../themes/Default/css/main.css' />
    <script type=\"text/javascript\" src=\"../lib/LiveValidation/livevalidation_standalone.compressed.js\"></script>
    <script type=\"text/javascript\" src=\"../lib/jquery/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"../lib/jquery/jquery-migrate.min.js\"></script>
    <script type='text/javascript' src='../resources/assets/js/core.js'></script>
";
    }

    // line 24
    public function block_sidebar($context, array $blocks = array())
    {
        // line 25
        echo "    <h2>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Welcome To Gibbon")), "html", null, true);
        echo "</h2>

    <p style='padding-top: 7px'>
        ";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Created by teachers, Gibbon is the school platform which solves real problems faced by educators every day.")), "html", null, true);
        echo "
        <br/><br/>
        ";
        // line 30
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Free, open source and flexible, Gibbon can morph to meet the needs of a huge range of schools.")), "html", null, true);
        echo "
        <br/><br/>
        ";
        // line 32
        echo twig_replace_filter(call_user_func_array($this->env->getFunction('__')->getCallable(), array("For support, please visit %1\$sgibbonedu.org%2\$s.")), array("%1\$s" => "<a target='_blank' href='https://gibbonedu.org/support'>", "%2\$s" => "</a>"));
        echo "
    </p>
";
    }

    public function getTemplateName()
    {
        return "installer/install.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 32,  67 => 30,  62 => 28,  55 => 25,  52 => 24,  36 => 12,  33 => 11,  15 => 9,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/
-->#}

{% extends \"index.twig.html\" %}

{% block head %}
    {{ block('meta', 'head.twig.html') }}

    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"../favicon.ico\"/>
    <link rel='stylesheet' type='text/css' href='../resources/assets/css/theme.min.css' />
    <link rel='stylesheet' type='text/css' href='../resources/assets/css/core.min.css' />
    <link rel='stylesheet' type='text/css' href='../themes/Default/css/main.css' />
    <script type=\"text/javascript\" src=\"../lib/LiveValidation/livevalidation_standalone.compressed.js\"></script>
    <script type=\"text/javascript\" src=\"../lib/jquery/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"../lib/jquery/jquery-migrate.min.js\"></script>
    <script type='text/javascript' src='../resources/assets/js/core.js'></script>
{% endblock head %}

{% block sidebar %}
    <h2>{{ __('Welcome To Gibbon') }}</h2>

    <p style='padding-top: 7px'>
        {{ __('Created by teachers, Gibbon is the school platform which solves real problems faced by educators every day.') }}
        <br/><br/>
        {{ __('Free, open source and flexible, Gibbon can morph to meet the needs of a huge range of schools.') }}
        <br/><br/>
        {{ __('For support, please visit %1\$sgibbonedu.org%2\$s.')|replace({'%1\$s': \"<a target='_blank' href='https://gibbonedu.org/support'>\", '%2\$s': '</a>' })|raw }}
    </p>
{% endblock sidebar %}
", "installer/install.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/installer/install.twig.html");
    }
}
