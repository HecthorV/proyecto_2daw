<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evento::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('nombre', 'Nombre'),
            DateField::new('fechaInicio', 'Fecha de Inicio'),//->hideOnForm()->hideOnIndex(),
            DateField::new('fechaFin', 'Fecha de Fin')->hideOnIndex(),
        ];
    }
}
