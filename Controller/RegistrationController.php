<?php

/*
 * This file is part of the EpixaUserBundle package.
 *
 * (c) Epixa <http://epixa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Epixa\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Request,
    Epixa\UserBundle\Form\Type\RegistrationType,
    Epixa\UserBundle\Entity\User;

/**
 * @author Court Ewing <court@epixa.com>
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/signup", name="epixa_user_signup")
     * @Template()
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new RegistrationType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->get('epixa_user.service.user')->add($user);

                $this->get('session')->setFlash('notice', 'Your account has been created.');
                return $this->redirect($this->generateUrl('epixa_user_view_user', array('id' => $user->getId())));
            }
        }

        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }
}