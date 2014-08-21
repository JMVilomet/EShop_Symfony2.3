<?php
// Généré automatiquement via la commande doctrine:generate:crud

namespace EShop\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EShop\BoutiqueBundle\Entity\article;
use EShop\BoutiqueBundle\Form\articleType;

/**
 * article controller.
 *
 */
class articleController extends Controller
{

    /**
     * Lists all article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EShopBoutiqueBundle:article')->findAll();

        return $this->render('EShopAdminBundle:article:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new article entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new article();
        $entity->setEnligne(true);
        $entity->setLot(1);
        $entity->setCab("12345");
        $entity->setDateAjout(new \DateTime());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $entity->getId())));
        }

        return $this->render('EShopAdminBundle:article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a article entity.
     *
     * @param article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(article $entity)
    {
        $form = $this->createForm(new articleType(), $entity, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', "attr"=>array("class"=>"button buttonBig")));
        return $form;
    }

    /**
     * Displays a form to create a new article entity.
     *
     */
    public function newAction()
    {
        $entity = new article();
        $form   = $this->createCreateForm($entity);

        return $this->render('EShopAdminBundle:article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EShopBoutiqueBundle:article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EShopAdminBundle:article:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EShopBoutiqueBundle:article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find article entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EShopAdminBundle:article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a article entity.
    *
    * @param article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(article $entity)
    {
        $form = $this->createForm(new articleType(), $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Mettre à jour', "attr"=>array("class"=>"button buttonBig")));

        return $form;
    }
    /**
     * Edits an existing article entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EShopBoutiqueBundle:article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }

        return $this->render('EShopAdminBundle:article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a article entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EShopBoutiqueBundle:article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', "attr"=>array("class"=>"smlButton")))
            ->getForm()
        ;
    }
}
