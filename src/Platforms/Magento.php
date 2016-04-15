<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Platforms/Magento.php
 */
namespace JaegerApp\Platforms;

use JaegerApp\Platforms\AbstractPlatform;

/**
 * Jaeger - Magento Platform Object
 *
 * The bridge between mithra62 code and Magento specific logic
 *
 * @package Platforms\Magento
 * @author Eric Lamb <eric@mithra62.com>
 */
class Magento extends AbstractPlatform
{
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getDbCredentials()
     */
    public function getDbCredentials()
    {
        //$encryptedData = \Mage::helper('core')->encrypt("This will be encrypted");
        $resources = \Mage::getConfig()->getNode('global/resources');
        if( $resources instanceof \Mage_Core_Model_Config_Element )
        {
            //we only want to use the writable table since we use our own everything
            $write = \Mage::getConfig()->getNode('global/resources/default_write/connection');
            $db_node = 'default_setup';
            if( $write instanceof \Mage_Core_Model_Config_Element )
            {
                $db_node = $write->use;
            }
            
            $db_data = \Mage::getConfig()->getNode('global/resources/'.$db_node.'/connection');
            $prefix = \Mage::getConfig()->getNode('global/resources/db/table_prefix');
            
            if( $db_data instanceof \Mage_Core_Model_Config_Element )
            {
                return array(
                    'user' => $db_data->username,
                    'password' => $db_data->password,
                    'database' => $db_data->dbname,
                    'host' => $db_data->host,
                    'prefix' => (string)$prefix,
                    'settings_table_name' => (string)$prefix . 'backup_pro_settings'
                );
            }
        }
        
        throw new \Exception('Can\'t access databse credentiasl!');
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getEmailConfig()
     */
    public function getEmailConfig()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getCurrentUrl()
     */
    public function getCurrentUrl()
    {
        return \Mage::helper('core/url')->getCurrentUrl();
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getSiteName()
     */
    public function getSiteName()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getTimezone()
     */
    public function getTimezone()
    {
        return \Mage::getStoreConfig('general/locale/timezone', \Mage::app()->getStore());
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getSiteUrl()
     */
    public function getSiteUrl()
    {
        return \Mage::getStoreConfig('web/secure/base_url', \Mage::app()->getStore());
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getEncryptionKey()
     */
    public function getEncryptionKey()
    {
        return (string)\Mage::getConfig()->getNode('global/crypt/key');
    }
    
    /**
     * (non-PHPdoc)
     * @see \JaegerApp\Platforms\AbstractPlatform::getConfigOverrides()
     */
    public function getConfigOverrides()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @param string $url 
     * @see \JaegerApp\Platforms\AbstractPlatform::redirect()
     */
    public function redirect($url)
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @param string $key
     * @param string $default 
     * @see \JaegerApp\Platforms\AbstractPlatform::getPost()
     */
    public function getPost($key, $default = false)
    {
        
    }
}