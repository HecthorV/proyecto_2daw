<?php

namespace App\Controller\Admin;

use App\Entity\Actividad;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActividadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actividad::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
//        $id= $entityInstance->getId();
//        dump($context->getEntity()->getInstance());
//        dd($context);
    */
    public function editRedirect(AdminContext $context) {
        $actividad = $context->getEntity()->getInstance();
        $id= $actividad->getId();

        return $this->redirectToRoute('app-editar-actividad',[
            'id' => $id,
            'actividad' => $actividad,
        ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->linkToRoute('app-crear-actividad', [])
                    ->setIcon('fa-solid fa-circle-plus')
                    ->setLabel("Crear actividad")
                ;
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action
                    ->setIcon('fas fa-search content-search-icon')
                    ->setLabel("Detallar")
                    ;
            })
             ->update(Crud::PAGE_INDEX, Action::EDIT,function(Action $action){
                 return $action
//                     ->linkToRoute('app-editar-actividad', [])
                     ->linkToCrudAction('editRedirect')
                     ->setIcon('fa fa-file-alt')
                     ->setLabel("Editar")
                 ;
             })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action
                    ->setIcon('fa-solid fa-trash')
                    ->setLabel("Eliminar")
                    ;
            })
            // ->add(Crud::PAGE_INDEX, Action::new('editar_recursos_de_actividad')
            //     ->setIcon('fa fa-star')
            //     ->setLabel('Editar recursos')
            //     ->linkToCrudAction('editRecursosRedirect')
            // )
        ;
    }
}
