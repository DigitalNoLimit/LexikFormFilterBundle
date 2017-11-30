<?php

namespace Lexik\Bundle\FormFilterBundle\DependencyInjection\Compiler;

use Lexik\Bundle\FormFilterBundle\Filter\DataExtractor\FormDataExtractor;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Add extraction methods to the data extraction service.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class FormDataExtractorPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition(FormDataExtractor::class)) {
            $definition = $container->getDefinition(FormDataExtractor::class);

            foreach ($container->findTaggedServiceIds('lexik_form_filter.data_extraction_method') as
                     $id => $attributes) {
                $definition->addMethodCall('addMethod', array(new Reference($id)));
            }
        }
    }
}
