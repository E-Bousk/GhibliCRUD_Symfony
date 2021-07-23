<?php

namespace App\Form;

use App\Entity\Anim;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('kanjiTitle', null, [
                'label' => 'Titre en Kanji'
            ])
            ->add('japTitle', null, [
                'label' => 'Titre en Japonais'
            ])
            ->add('year') // pour la traduction, voir le « 'translation_domain' => 'forms' » plus bas + création fichier « translations/forms.fr.yaml » + edition fichier « config/packages/translations.yaml » (mettre 'local' en 'fr')
            ->add('director', ChoiceType::class, [
                // 'choices' => Anim::DIRECTOR --> les clefs et valeurs sont inversées dans notre select, du coup on crée une methode "getRealisateur" (voir plus bas)
                'choices' => $this->getRealisateur()
            ])
        ;
    }

    private function getRealisateur()
    {
        $choices= Anim::DIRECTOR;
        $output= array_flip($choices);
        return $output;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Anim::class,
            'translation_domain' => 'forms'
        ]);
    }

}
