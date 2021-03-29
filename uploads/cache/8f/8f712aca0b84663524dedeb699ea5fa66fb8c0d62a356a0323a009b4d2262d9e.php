<?php

/* installer/config.twig.html */
class __TwigTemplate_fdfde575ed29bfc0d4e81b817d8c53502dfbf1180a6163e403dfb17c0a37ff09 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 8
        echo "<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Sets the database connection information.
 * You can supply an optional \$databasePort if your server requires one.
 */
\$databaseServer = '";
        // line 31
        echo ($context["databaseServer"] ?? null);
        echo "';
\$databaseUsername = '";
        // line 32
        echo ($context["databaseUsername"] ?? null);
        echo "';
\$databasePassword = '";
        // line 33
        echo ($context["databasePassword"] ?? null);
        echo "';
\$databaseName = '";
        // line 34
        echo ($context["databaseName"] ?? null);
        echo "';

/**
 * Sets a globally unique id, to allow multiple installs on a single server.
 */
\$guid = '";
        // line 39
        echo ($context["guid"] ?? null);
        echo "';

/**
 * Sets system-wide caching factor, used to balance performance and freshness.
 * Value represents number of page loads between cache refresh.
 * Must be positive integer. 1 means no caching.
 */
\$caching = 10;
";
    }

    public function getTemplateName()
    {
        return "installer/config.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 39,  60 => 34,  56 => 33,  52 => 32,  48 => 31,  23 => 8,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/
-->#}
<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Sets the database connection information.
 * You can supply an optional \$databasePort if your server requires one.
 */
\$databaseServer = '{{ databaseServer|raw }}';
\$databaseUsername = '{{ databaseUsername|raw }}';
\$databasePassword = '{{ databasePassword|raw }}';
\$databaseName = '{{ databaseName|raw }}';

/**
 * Sets a globally unique id, to allow multiple installs on a single server.
 */
\$guid = '{{ guid|raw }}';

/**
 * Sets system-wide caching factor, used to balance performance and freshness.
 * Value represents number of page loads between cache refresh.
 * Must be positive integer. 1 means no caching.
 */
\$caching = 10;
", "installer/config.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/installer/config.twig.html");
    }
}
