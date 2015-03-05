<?php

namespace App\Data\Proxy\__CG__\App\Data\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \App\Data\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'emailAddress', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'gender', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'keyStretchingIterations', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'lastEditionDateTime', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'lastName', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'passwordHash', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'role', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'salt', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'version');
        }

        return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'emailAddress', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'gender', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'keyStretchingIterations', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'lastEditionDateTime', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'lastName', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'passwordHash', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'role', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'salt', '' . "\0" . 'App\\Data\\Entity\\User' . "\0" . 'version');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getEmailAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailAddress', array());

        return parent::getEmailAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', array());

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getKeyStretchingIterations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getKeyStretchingIterations', array());

        return parent::getKeyStretchingIterations();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', array());

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordHash()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordHash', array());

        return parent::getPasswordHash();
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRole', array());

        return parent::getRole();
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', array());

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreationDateTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreationDateTime', array());

        return parent::setCreationDateTime();
    }

}
