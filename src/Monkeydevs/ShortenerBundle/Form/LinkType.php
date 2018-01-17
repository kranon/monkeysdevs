<?php

namespace Monkeydevs\ShortenerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LinkType extends AbstractType {
	/**
	 * {@inheritdoc}
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder->add( 'url', TextType::class,
			[
				'label' => 'Enter URL',
				'attr'  => [
					'placeholder' => 'http://google.com',
				],
			]
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( array(
			'data_class' => 'Monkeydevs\ShortenerBundle\Entity\Link',
		) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'monkeydevs_shortenerbundle_link';
	}

}
