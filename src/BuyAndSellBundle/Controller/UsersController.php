<?php

namespace BuyAndSellBundle\Controller;

use BuyAndSellBundle\Entity\Role;
use BuyAndSellBundle\Entity\User;
use BuyAndSellBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UsersController extends Controller
{
    /**
     * @Route("/register", name="user_register", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {

        $errors = '';
        return $this->render('default/register.html.twig',
            ['errors' => $errors,
                'form' => $this->createForm(UserType::class)->createView()]);
    }
    /**
     * @Route("/register", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function registerProcess(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);
            /** @var Role $userRole */
            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

                if (count($errors) > 0) {
                    return $this->render('default/register.html.twig', [
                        'errors' => $errors
                    ]);
                }

            return $this->redirectToRoute("security_login");
        }

        return $this->render('default/register.html.twig',
            ['errors' => $errors,
                'form' => $this->createForm(UserType::class)->createView(),
                ]);
    }
}
