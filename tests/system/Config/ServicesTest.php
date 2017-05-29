<?php namespace Config;

class ServicesTest extends \CIUnitTestCase
{

	protected $config;
	protected $original;

	public function setUp()
	{
		$this->original = $_SERVER;
		$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'es; q=1.0, en; q=0.5';
		$this->config = new App();
		$this->config->negotiateLocale = true;
		$this->config->supportedLocales = ['en', 'es'];
	}

	public function tearDown()
	{
		$_SERVER = $this->original;
	}

	public function testNewCurlRequest()
	{
		$actual = Services::curlrequest();
		$this->assertInstanceOf(\CodeIgniter\HTTP\CURLRequest::class, $actual);
	}

	public function testNewExceptions()
	{
		$actual = Services::exceptions($this->config);
		$this->assertInstanceOf(\CodeIgniter\Debug\Exceptions::class, $actual);
	}

	public function testNewExceptionsWithNullConfig()
	{
		$actual = Services::exceptions(null, false);
		$this->assertInstanceOf(\CodeIgniter\Debug\Exceptions::class, $actual);
	}

	public function testNewIterator()
	{
		$actual = Services::iterator();
		$this->assertInstanceOf(\CodeIgniter\Debug\Iterator::class, $actual);
	}

	public function testNewNegotiatorWithNullConfig()
	{
		$actual = Services::negotiator(null);
		$this->assertInstanceOf(\CodeIgniter\HTTP\Negotiate::class, $actual);
	}

	public function testNewClirequestWithNullConfig()
	{
		$actual = Services::clirequest(null);
		$this->assertInstanceOf(\CodeIgniter\HTTP\CLIRequest::class, $actual);
	}

	public function testNewPager()
	{
		$actual = Services::pager(null);
		$this->assertInstanceOf(\CodeIgniter\Pager\Pager::class, $actual);
	}

	public function testNewThrottlerFromShared()
	{
		$actual = Services::throttler();
		$this->assertInstanceOf(\CodeIgniter\Throttle\Throttler::class, $actual);
	}

	public function testNewThrottler()
	{
		$actual = Services::throttler(false);
		$this->assertInstanceOf(\CodeIgniter\Throttle\Throttler::class, $actual);
	}

	public function testNewToolbar()
	{
		$actual = Services::toolbar(null);
		$this->assertInstanceOf(\CodeIgniter\Debug\Toolbar::class, $actual);
	}

	public function testNewUri()
	{
		$actual = Services::uri(null);
		$this->assertInstanceOf(\CodeIgniter\HTTP\URI::class, $actual);
	}

	public function testNewValidation()
	{
		$actual = Services::validation(null);
		$this->assertInstanceOf(\CodeIgniter\Validation\Validation::class, $actual);
	}

	public function testNewViewcellFromShared()
	{
		$actual = Services::viewcell();
		$this->assertInstanceOf(\CodeIgniter\View\Cell::class, $actual);
	}

	public function testNewViewcell()
	{
		$actual = Services::viewcell(false);
		$this->assertInstanceOf(\CodeIgniter\View\Cell::class, $actual);
	}

	public function testNewSession()
	{
		$actual = Services::session($this->config);
		$this->assertInstanceOf(\CodeIgniter\Session\Session::class, $actual);
	}

	public function testNewSessionWithNullConfig()
	{
		$actual = Services::session(null, false);
		$this->assertInstanceOf(\CodeIgniter\Session\Session::class, $actual);
	}

	public function testCallStatic()
	{
		$actual = \CodeIgniter\Config\Services::SESSION(null, false);
		$this->assertInstanceOf(\CodeIgniter\Session\Session::class, $actual);
	}

}
