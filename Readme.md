# TYPO3 Extension ``eh_bootstrap`` 

A basic TYPO3 extension which includes examples for useful TYPO3 functions to use in new extensions.
It could be used as example in the TYPO3 Bootstrap package.

## Features

 - [Example-1]: Extension Manager configuration file reading (ext_conf_template.txt)
 - [Example-2]: an update script which could be executed in Extension Manager
 - [Example-3]: a basic composer.json which will be updated from time to time
 - [Example-4]: a custom content element which uses default fields and shows a backend preview (button)
 - [Example-5]: an Extbase plugin which shows a basic backend preview and renders two buttons for demonstration of AJAX requests
 - [Example-6]: an example Extbase dispatcher for rendering AJAX requests via eID
 - [Example-7]: an example for AJAX requests with typoscript_rendering extension
 - [Example-8]: automatically include the constants and setup for the extension
 - [Example-9]: a backend module to show the basic functionality
 - [Example-10]: a default scheduler task with custom fields
 - [Example-11]: a scheduler task as command controller task (could be executed via command line)
 - [Example-12]: register extension icons with the icon registry
 - [Example-13]: custom flash messages ViewHelper to get all flash messages used in [Example-2]


## Usage


### 1) Installation

The simplest way to test the extension is to use the TYPO3 Bootstrap package as base system.
You need also the extension typoscript_rendering.

#### Installation using Composer

The recommended way to install the extension is by using (Composer)[2]. In your Composer based TYPO3 project root, just do `composer require ehaerer/eh-bootstrap`. 

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install the extension with the extension manager module.

### 2) Minimal setup

No special setup is needed. All files will be included automatically. Read the [documentation](Documentation/Introduction/Index.rst).



[1]: https://docs.typo3.org/typo3cms/extensions/news/
[2]: https://getcomposer.org/