<?php

/**
 * Test: Nette\Application\UI\Presenter::isLinkCurrent()
 *
 * @author     David Grudl
 * @author     Michael Moravec
 * @package    Nette\Application\UI
 */

use Nette\Http,
	Nette\Application;



require __DIR__ . '/../bootstrap.php';



class TestPresenter extends Application\UI\Presenter
{


	protected function createTemplate($class = NULL)
	{
	}



	protected function startup()
	{
		parent::startup();

		// test silent mode
		$this->invalidLinkMode = self::INVALID_LINK_SILENT;
		Assert::true( $this->isLinkCurrent($this->getAction()) );
		Assert::true( $this->isLinkCurrent($this->getAction(TRUE)) );
		Assert::false( $this->isLinkCurrent('valid'));
		Assert::false( $this->isLinkCurrent('invalid'));
		Assert::false( $this->isLinkCurrent('Invalid:') );

		// test warning mode
		$this->invalidLinkMode = self::INVALID_LINK_WARNING;
		Assert::true( $this->isLinkCurrent($this->getAction()) );
		Assert::true( $this->isLinkCurrent($this->getAction(TRUE)) );
		Assert::false( $this->isLinkCurrent('valid'));
		Assert::false( $this->isLinkCurrent('invalid'));
		Assert::false( $this->isLinkCurrent('Invalid:') );

		// test exception mode
		$this->invalidLinkMode = self::INVALID_LINK_EXCEPTION;
		Assert::true( $this->isLinkCurrent($this->getAction()) );
		Assert::true( $this->isLinkCurrent($this->getAction(TRUE)) );
		Assert::false( $this->isLinkCurrent('valid'));
		Assert::false( $this->isLinkCurrent('invalid'));
		Assert::false( $this->isLinkCurrent('Invalid:') );


	}



	public function actionValid()
	{
	}

}


$container = id(new Nette\Config\Configurator)->setTempDirectory(TEMP_DIR)->createContainer();

$url = new Http\UrlScript('http://localhost/index.php');
$url->setScriptPath('/index.php');
unset($container->httpRequest);
$container->httpRequest = new Http\Request($url);

$application = $container->application;
$application->router[] = new Application\Routers\SimpleRouter();

$request = new Application\Request('Test', Http\Request::GET, array());

$presenter = new TestPresenter;
$container->callMethod($presenter->injectPrimary);
$presenter->autoCanonicalize = FALSE;
$presenter->run($request);
