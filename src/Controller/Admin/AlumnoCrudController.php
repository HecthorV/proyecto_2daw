<?php

namespace App\Controller\Admin;

use App\Entity\Alumno;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlumnoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alumno::class;
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

    public function configureAssets(Assets $assets): Assets
    {
        return Assets::new()
            // JQUERY
            ->addCssFile('jquery/jquery-ui-1.13.3/jquery-ui.structure.min.css')
            ->addCssFile('jquery/jquery-ui-1.13.3/jquery-ui.theme.min.css')
            ->addCssFile('jquery/jquery-ui-1.13.3/jquery-ui.min.css')
            ->addJsFile('jquery/jquery-3.7.1.min.js')
            ->addJsFile('jquery/jquery-ui-1.13.3/jquery-ui.min.js')

//            ->addJsFile('js/easyadmin/alumnoCrudController.js')
            ->addJsFile('js/easyadmin/alumnoCrudControllerCreate.js')
            ->addJsFile('js/easyadmin/alumnoCrudControllerEvents.js')
            ->addJsFile('js/easyadmin/altamasiva.js')
            ->addCssFile('css/easyadmin/alumnoCrudController.css')

            ->addCssFile('css/easyadmin/estilosprincipales.css')
            ;
    }
}
