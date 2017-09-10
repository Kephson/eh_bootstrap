# TYPO3 Extension ``eh_bootstrap`` 

A basic TYPO3 extension which includes examples for useful TYPO3 functions to use in new extensions.
It could be used as example in the TYPO3 Bootstrap package.

## Features

 - Example for Extension Manager configuration
 - Example for an update script which could be executed in Extension Manager
 - A basic composer.json which will be updated from time to time
 - A custom content element which uses default fields and shows a backend preview (button)
 - An Extbase plugin which shows a basic backend preview and renders two buttons for demonstration of Ajax requests
 - An example Extbase dispatcher for rendering Ajax requests via eID
 - An example for Ajax requests with typoscript_rendering extension
 - Automatically includes the constants and setup for the extension
 - A backend module to show the basic functionality
 - A scheduler task with custom fields
 - A scheduler task as command controller task (could be executed via command line)

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