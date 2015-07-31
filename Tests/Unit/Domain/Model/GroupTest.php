<?php

namespace Fnn\FnnAddress\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 599media-Team <info@599media.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Fnn\FnnAddress\Domain\Model\Group.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Jorinde Milde <jorinde.milde@599media.de>
 */
class GroupTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Fnn\FnnAddress\Domain\Model\Group
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Fnn\FnnAddress\Domain\Model\Group();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPersonsReturnsInitialValueForPerson() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPersons()
		);
	}

	/**
	 * @test
	 */
	public function setPersonsForObjectStorageContainingPersonSetsPersons() {
		$person = new \Fnn\FnnAddress\Domain\Model\Person();
		$objectStorageHoldingExactlyOnePersons = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePersons->attach($person);
		$this->subject->setPersons($objectStorageHoldingExactlyOnePersons);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePersons,
			'persons',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPersonToObjectStorageHoldingPersons() {
		$person = new \Fnn\FnnAddress\Domain\Model\Person();
		$personsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$personsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($person));
		$this->inject($this->subject, 'persons', $personsObjectStorageMock);

		$this->subject->addPerson($person);
	}

	/**
	 * @test
	 */
	public function removePersonFromObjectStorageHoldingPersons() {
		$person = new \Fnn\FnnAddress\Domain\Model\Person();
		$personsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$personsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($person));
		$this->inject($this->subject, 'persons', $personsObjectStorageMock);

		$this->subject->removePerson($person);

	}

	/**
	 * @test
	 */
	public function getOrganisationsReturnsInitialValueForOrganisation() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getOrganisations()
		);
	}

	/**
	 * @test
	 */
	public function setOrganisationsForObjectStorageContainingOrganisationSetsOrganisations() {
		$organisation = new \Fnn\FnnAddress\Domain\Model\Organisation();
		$objectStorageHoldingExactlyOneOrganisations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneOrganisations->attach($organisation);
		$this->subject->setOrganisations($objectStorageHoldingExactlyOneOrganisations);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneOrganisations,
			'organisations',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addOrganisationToObjectStorageHoldingOrganisations() {
		$organisation = new \Fnn\FnnAddress\Domain\Model\Organisation();
		$organisationsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$organisationsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($organisation));
		$this->inject($this->subject, 'organisations', $organisationsObjectStorageMock);

		$this->subject->addOrganisation($organisation);
	}

	/**
	 * @test
	 */
	public function removeOrganisationFromObjectStorageHoldingOrganisations() {
		$organisation = new \Fnn\FnnAddress\Domain\Model\Organisation();
		$organisationsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$organisationsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($organisation));
		$this->inject($this->subject, 'organisations', $organisationsObjectStorageMock);

		$this->subject->removeOrganisation($organisation);

	}
}
