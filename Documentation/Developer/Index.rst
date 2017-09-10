.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

Use this documentation to find out what to configure in your extension to use the functions of the TYPO3 core.
You will find all the parts you need for a feature commented in the code with the number of the example.


.. _developer-examples:

Extension manager configuration
-------------------------------

Find it in the code commented with [Example-1].

Setup a text file ext_conf_template.txt in the root directory of your extension.
In the textfile you could use variables to define what the administrator could configure here.

.. code-block:: txt

	# cat=basic; type=boolean; label=Example for boolean
	boolean = 1
	# cat=basic; type=string; label=Example uri
	example_uri = https://www.github.com

In this extension the configuration is used in the 
Classes/Controller/AbstractController.php and written to a variable which 
could be accessed inside of the class.

.. code-block:: php
	/**
	 * settings in extension manager
	 * [Example-1]
	 * 
	 * @var array
	 */
	protected $emSettings;

	public function __construct()
	{
		parent::__construct();

		/* [Example-1] */
		$this->emSettings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
	}

or some other language:

.. code-block:: javascript
   :linenos:
   :emphasize-lines: 2-4

	$(document).ready(
		function () {
			doStuff();
		}
	);
