<?php 

class UnitTest extends Orchestra\Testbench\TestCase {

	/**
	 * Package Providers 
	 *
	 * @return array
	 */
	protected function getPackageProviders()
    {
        return array(
				'Barryvdh\Debugbar\ServiceProvider',
	        	'Ahir\Pathman\PathmanServiceProvider'
        	);
    }

	/**
	 * Package Aliases
	 *
	 * @return array
	 */
    protected function getPackageAliases()
    {
        return array(
			'Debugbar' => 'Barryvdh\Debugbar\Facade',
        );
    }

	/**
	 * Delete Directory
	 *
	 * @param  string $dir
	 * @return boolean
	 */
	protected function delTree($dir) 
	{ 
		$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
			(is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
		} 
		return rmdir($dir); 
  	}     

  	/**
  	 * Test Create
  	 *
  	 * @return null
  	 */
  	public function testSet()
  	{
  		// Method is is tested
    	$this->assertTrue(Pathman::set('sample'));
        // Deleting test folders
    	$this->delTree('sample');
  	}

  	/**
  	 * Test Time Folders
  	 *
  	 * @return null
  	 */
	public function testTimeFolders()
    {
    	// Hashing algorithm set
    	$hashing = Config::set('pathman::hashing', false);
    	// Method callind
    	$value = Pathman::timeFolders('root');

    	// True response 
    	$required = 'root/'
    				.date('Y').'/'
    				.date('m').'/'
    				.date('d').'/'
    				.date('H').'/'
    				.date('i').'/';
    	// Testing
    	$this->assertEquals($value, $required);

        // Deleting test folders
    	$this->delTree('root');
    }    

}