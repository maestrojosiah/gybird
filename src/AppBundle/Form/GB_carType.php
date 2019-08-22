<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GB_carType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cMake', EntityType::class, [
                // looks for choices from this entity
                'class' => 'AppBundle:GB_make',
            
                // uses the User.username property as the visible option string
                'choice_label' => 'mName',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])        
            ->add('cModel', EntityType::class, [
                // looks for choices from this entity
                'class' => 'AppBundle:GB_model',
            
                // uses the User.username property as the visible option string
                'choice_label' => 'mdName',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])        
            ->add('cSteering', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'Right' => 'right',
                    'Left' => 'left',
                ),
            ))
            ->add('cEngCap', TextType::class, array('label' => false ))
            ->add('cRegYear', TextType::class, array('label' => false ))
            ->add('cPrice', TextType::class, array('label' => false ))
            ->add('cFuel', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'Gasoline' => 'gasoline',
                    'Diesel' => 'diesel',
                    'Other' => 'other'
                ),
            ))
            ->add('cBodyStyle', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'HatchBack' => 'hatchback',
                    'Other' => 'other',
                ),
            ))
            ->add('cExtColor', TextType::class, array('label' => false ))
            ->add('cIntColor', TextType::class, array('label' => false ))
            ->add('cDriveType', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    '2 Wheel Drive' => 'twowheeldrive',
                    '4 Wheel Drive' => 'fourwheeldrive',
                ),
            ))
            ->add('cDoors', TextType::class, array('label' => false ))
            ->add('cVin', TextType::class, array('label' => false ))
            ->add('cModelCode', TextType::class, array('label' => false ))
            ->add('cMileage', TextType::class, array('label' => false ))
            ->add('cTrans', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'Automatic' => 'automatic',
                    'Manual' => 'manual',
                ),
            ))
            ->add('availability', ChoiceType::class, array(
                'label' => false,
                'choices'  => array(
                    'Available' => 'available',
                    'SOLD' => 'not_available',
                ),
            ))
            ->add('image', FileType::class, array('label' => 'Image (PNG/JPG file)', 'data_class' => null))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GB_car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_gb_car';
    }


}
