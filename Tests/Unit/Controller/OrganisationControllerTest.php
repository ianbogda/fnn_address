<?php
namespace Fnn\FnnAddress\Tests\Unit\Controller;
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
 * Test case for class Fnn\FnnAddress\Controller\OrganisationController.
 *
 * @author Jorinde Milde <jorinde.milde@599media.de>
 */
class OrganisationControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Fnn\FnnAddress\Controller\OrganisationController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Fnn\\FnnAddress\\Controller\\OrganisationController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllOrganisationsFromRepositoryAndAssignsThemToView() {

		$allOrganisations = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$organisationRepository = $this->getMock('Fnn\\FnnAddress\\Domain\\Repository\\OrganisationRepository', array('findAll'), array(), '', FALSE);
		$organisationRepository->expects($this->once())->method('findAll')->will($this->returnValue($allOrganisations));
		$this->inject($this->subject, 'organisationRepository', $organisationRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('organisations', $allOrganisations);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenOrganisationToView() {
		$organisation = new \Fnn\FnnAddress\Domain\Model\Organisation();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('organisation', $organisation);

		$this->subject->showAction($organisation);
	}
}
