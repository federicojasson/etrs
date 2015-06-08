<?php

namespace App\Data\Proxy\__CG__\App\Data\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Consultation extends \App\Data\Entity\Consultation implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'clinicalImpression', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'cognitiveTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'comments', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'date', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deleted', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deleter', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deletionDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'diagnosis', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'imagingTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'laboratoryTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'lastEditionDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'lastEditor', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'medicalAntecedents', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'medicines', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'patient', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'patientImpression', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'presentingProblem', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'studies', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'treatments', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'version');
        }

        return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'clinicalImpression', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'cognitiveTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'comments', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'date', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deleted', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deleter', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'deletionDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'diagnosis', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'imagingTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'laboratoryTestResults', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'lastEditionDateTime', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'lastEditor', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'medicalAntecedents', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'medicines', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'patient', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'patientImpression', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'presentingProblem', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'studies', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'treatments', '' . "\0" . 'App\\Data\\Entity\\Consultation' . "\0" . 'version');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Consultation $proxy) {
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
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function addCognitiveTestResult($cognitiveTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCognitiveTestResult', array($cognitiveTestResult));

        return parent::addCognitiveTestResult($cognitiveTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function addImagingTestResult($imagingTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addImagingTestResult', array($imagingTestResult));

        return parent::addImagingTestResult($imagingTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function addLaboratoryTestResult($laboratoryTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addLaboratoryTestResult', array($laboratoryTestResult));

        return parent::addLaboratoryTestResult($laboratoryTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function addMedicalAntecedent($medicalAntecedent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMedicalAntecedent', array($medicalAntecedent));

        return parent::addMedicalAntecedent($medicalAntecedent);
    }

    /**
     * {@inheritDoc}
     */
    public function addMedicine($medicine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMedicine', array($medicine));

        return parent::addMedicine($medicine);
    }

    /**
     * {@inheritDoc}
     */
    public function addTreatment($treatment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTreatment', array($treatment));

        return parent::addTreatment($treatment);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'delete', array($user));

        return parent::delete($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getClinicalImpression()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClinicalImpression', array());

        return parent::getClinicalImpression();
    }

    /**
     * {@inheritDoc}
     */
    public function getCognitiveTestResults()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCognitiveTestResults', array());

        return parent::getCognitiveTestResults();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreator', array());

        return parent::getCreator();
    }

    /**
     * {@inheritDoc}
     */
    public function getDiagnosis()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiagnosis', array());

        return parent::getDiagnosis();
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
    public function getImagingTestResults()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImagingTestResults', array());

        return parent::getImagingTestResults();
    }

    /**
     * {@inheritDoc}
     */
    public function getLaboratoryTestResults()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLaboratoryTestResults', array());

        return parent::getLaboratoryTestResults();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastEditor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastEditor', array());

        return parent::getLastEditor();
    }

    /**
     * {@inheritDoc}
     */
    public function getMedicalAntecedents()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMedicalAntecedents', array());

        return parent::getMedicalAntecedents();
    }

    /**
     * {@inheritDoc}
     */
    public function getMedicines()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMedicines', array());

        return parent::getMedicines();
    }

    /**
     * {@inheritDoc}
     */
    public function getPatient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPatient', array());

        return parent::getPatient();
    }

    /**
     * {@inheritDoc}
     */
    public function getStudies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStudies', array());

        return parent::getStudies();
    }

    /**
     * {@inheritDoc}
     */
    public function getTreatments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTreatments', array());

        return parent::getTreatments();
    }

    /**
     * {@inheritDoc}
     */
    public function isDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isDeleted', array());

        return parent::isDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function removeCognitiveTestResult($cognitiveTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCognitiveTestResult', array($cognitiveTestResult));

        return parent::removeCognitiveTestResult($cognitiveTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function removeImagingTestResult($imagingTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeImagingTestResult', array($imagingTestResult));

        return parent::removeImagingTestResult($imagingTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function removeLaboratoryTestResult($laboratoryTestResult)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeLaboratoryTestResult', array($laboratoryTestResult));

        return parent::removeLaboratoryTestResult($laboratoryTestResult);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMedicalAntecedent($medicalAntecedent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMedicalAntecedent', array($medicalAntecedent));

        return parent::removeMedicalAntecedent($medicalAntecedent);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMedicine($medicine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMedicine', array($medicine));

        return parent::removeMedicine($medicine);
    }

    /**
     * {@inheritDoc}
     */
    public function removeTreatment($treatment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeTreatment', array($treatment));

        return parent::removeTreatment($treatment);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', array());

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function setClinicalImpression($clinicalImpression)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClinicalImpression', array($clinicalImpression));

        return parent::setClinicalImpression($clinicalImpression);
    }

    /**
     * {@inheritDoc}
     */
    public function setComments($comments)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setComments', array($comments));

        return parent::setComments($comments);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreationDateTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreationDateTime', array());

        return parent::setCreationDateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreator($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreator', array($user));

        return parent::setCreator($user);
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDate', array($date));

        return parent::setDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setDiagnosis($diagnosis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiagnosis', array($diagnosis));

        return parent::setDiagnosis($diagnosis);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastEditionDateTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastEditionDateTime', array());

        return parent::setLastEditionDateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastEditor($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastEditor', array($user));

        return parent::setLastEditor($user);
    }

    /**
     * {@inheritDoc}
     */
    public function setPatient($patient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPatient', array($patient));

        return parent::setPatient($patient);
    }

    /**
     * {@inheritDoc}
     */
    public function setPatientImpression($impression)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPatientImpression', array($impression));

        return parent::setPatientImpression($impression);
    }

    /**
     * {@inheritDoc}
     */
    public function setPresentingProblem($presentingProblem)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPresentingProblem', array($presentingProblem));

        return parent::setPresentingProblem($presentingProblem);
    }

}
