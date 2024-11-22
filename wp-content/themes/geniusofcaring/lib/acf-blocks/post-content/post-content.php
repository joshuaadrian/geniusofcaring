<?php

/**
 * interactive-graphic Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'interactive-graphic-' . $block['id'];

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'interactive-graphic-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
     
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <ul class="interactive-graphic--list interactive-graphic--list-left">

        <li>
            <a href="#intellectually-curious--content" class="interactive-graphic--link is-showing"><span>Intellectually Curious</span></a>
        </li>

        <li>
            <a href="#rigorous--content" class="interactive-graphic--link"><span>Rigorous</span></a>
        </li>

        <li>
            <a href="#collaborative--content" class="interactive-graphic--link"><span>Collaborative</span></a>
        </li>

        <li>
            <a href="#personal-impact--content" class="interactive-graphic--link"><span>Personal Impact</span></a>
        </li>

        <li>
            <a href="#partnership--content" class="interactive-graphic--link"><span>Partnership</span></a>
        </li>
        
    </ul>

    <div class="interactive-graphic--circles">

        <div class="interactive-graphic--circles--outer">

            <div class="interactive-graphic--circles--inner">
            
            </div>
            
        </div>
        
    </div>

    <ul class="interactive-graphic--list interactive-graphic--list-right">

        <li>
            <a href="#integrity--content" class="interactive-graphic--link"><span>Integrity</span></a>
        </li>

        <li>
            <a href="#excellence--content" class="interactive-graphic--link"><span>Excellence</span></a>
        </li>

        <li>
            <a href="#growth--content" class="interactive-graphic--link"><span>Growth</span></a>
        </li>

        <li>
            <a href="#aspirational--content" class="interactive-graphic--link"><span>Aspirational</span></a>
        </li>

        <li>
            <a href="#inclusive--content" class="interactive-graphic--link"><span>Inclusive</span></a>
        </li>
        
    </ul>

    <div class="interactive-graphic--content">

        <div id="intellectually-curious--content" class="interactive-graphic--copy is-showing">
            <p>We ask thoughtful questions in our effort to synthesize information</p>
        </div>

        <div id="rigorous--content" class="interactive-graphic--copy">
            <p>A data-oriented and fact-based approach that identifies issues and allows for creative solutions</p>
        </div>

        <div id="collaborative--content" class="interactive-graphic--copy">
            <p>Fact-based and constructive debate among motivated participants with diverse viewpoints leads to better decisions</p>
        </div>

        <div id="personal-impact--content" class="interactive-graphic--copy">
            <p>Achieving our priorities requires that each of us make an identifiable difference</p>
        </div>

        <div id="partnership--content" class="interactive-graphic--copy">
            <p>Culture of communication, respect and alignment with each other and our management teams creates shared success</p>
        </div>

        <div id="integrity--content" class="interactive-graphic--copy">
            <p>We do things the right way and want to stay on the right side of change</p>
        </div>

        <div id="excellence--content" class="interactive-graphic--copy">
            <p>Getting better requires attention to detail and continuously identifying ways to improve</p>
        </div>

        <div id="growth--content" class="interactive-graphic--copy">
            <p>We seek to be business-builders and look for ways to create further value in the marketplace</p>
        </div>

        <div id="aspirational--content" class="interactive-graphic--copy">
            <p>A long term, optimistic approach leads to building better businesses and requires that decisions are appropriate and sustainable over a long horizon</p>
        </div>

        <div id="inclusive--content" class="interactive-graphic--copy">
            <p>Building a work environment that thrives on diversity, dialogue, engagement and respect</p>
        </div>

    </div>

</div>