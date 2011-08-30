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
    Epixa\UserBundle\Form\Type\UserType,
    Epixa\UserBundle\Entity\User;

/**
 * @author Court Ewing <court@epixa.com>
 */
class UserController extends Controller
{
    /**
     * Shows a paginated list of all users
     *
     * @Route("/users/{page}",
     *        name="epixa_user_list_users",
     *        requirements={"id"="\d+", "page"="\d+"},
     *        defaults={"page"=1})
     * @Template()
     *
     * @param integer $page
     * @return array
     */
    public function listAction($page = null)
    {
        return array(
            'users' => $this->get('epixa_user.service.user')->getAll($page),
            'page' => $page
        );
    }

    /**
     * @Route("/profile/{id}", requirements={"id"="\d+"}, name="epixa_user_view_user")
     * @Template()
     *
     * @param integer $id The unique identifier of the requested user
     * @return array
     */
    public function viewAction($id)
    {
        $user = $this->get('epixa_user.service.user')->get($id);

        return array(
            'user' => $user
        );
    }

    /**
     * @Route("/user/add", name="epixa_user_add_user")
     * @Template()
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function addAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->get('epixa_user.service.user')->add($user);

                $this->get('session')->setFlash('notice', 'User created');
                return $this->redirect($this->generateUrl('epixa_user_view_user', array('id' => $user->getId())));
            }
        }

        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }

    /**
     * @Route("/user/edit/{id}", requirements={"id"="\d+"}, name="epixa_user_edit_user")
     * @Template()
     *
     * @param integer $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function editAction($id, Request $request)
    {
        $service = $this->get('epixa_user.service.user');
        $user = $service->get($id);

        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $service->update($user);

                $this->get('session')->setFlash('notice', 'User updated');
                return $this->redirect($this->generateUrl('epixa_user_view_user', array('id' => $user->getId())));
            }
        }

        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }

    /**
     * @Route("/user/delete/{id}", requirements={"id"="\d+"}, name="epixa_user_delete_user")
     * @Template()
     *
     * @param integer $id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function deleteAction($id, Request $request)
    {
        $service = $this->get('epixa_user.service.user');
        $user = $service->get($id);

        if ($request->getMethod() == 'POST') {
            $service->delete($user);

            $this->get('session')->setFlash('notice', 'User deleted');
            return $this->redirect($this->generateUrl('epixa_user_list_users'));
        }

        return array(
            'user' => $user
        );
    }
}