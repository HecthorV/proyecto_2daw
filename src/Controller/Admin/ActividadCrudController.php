<?php

namespace App\Controller\Admin;

use App\Entity\Actividad;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
    */

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
            // ->update(Crud::PAGE_INDEX, Action::EDIT,function(Action $action){
            //     return $action
            //         ->linkToCrudAction('editRedirect') //Redirijir Action::EDIT a formulario personalizado en plantilla twig
            //         ->setIcon('fa fa-file-alt') // Icono personalizado 
            //         ->setLabel("Editar") // Label personalizado
            //     ;
            // })
            // ->add(Crud::PAGE_INDEX, Action::new('editar_recursos_de_actividad')
            //     ->setIcon('fa fa-star')
            //     ->setLabel('Editar recursos')
            //     ->linkToCrudAction('editRecursosRedirect')
            // )
        ;
    }
}
