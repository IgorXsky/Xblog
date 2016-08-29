<?php

namespace Xblog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Xblog\BlogBundle\Form\FormType;
use Xblog\BlogBundle\Entity\Contact;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blogs = $em->getRepository('XblogBlogBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('XblogBlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function aboutAction()
    {
        return $this->render('XblogBlogBundle:Page:about.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(FormType::class, $contact);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from xblog')
                    ->setFrom('contact@xblog.co.uk')
                    ->setTo($this->container->getParameter('xblog_blog.emails.contact_email'))
                    ->setBody($this->renderView('XblogBlogBundle:Page:contactEmail.txt.twig', array('contact' => $contact)));

                $this->get('mailer')->send($message);

                $this->addFlash('xblog-notice', 'Your contact enquiry was successfully sent. Thank you!');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('XblogBlogBundle_contact'));
            }
        }

        return $this->render('XblogBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $commentLimit   = $this->container
            ->getParameter('xblog_blog.comments.latest_comment_limit');
        $latestComments = $em->getRepository('XblogBlogBundle:Comment')
            ->getLatestComments($commentLimit);

        return $this->render('XblogBlogBundle:Page:sidebar.html.twig', array(
            'latestComments'    => $latestComments
        ));
    }


}

