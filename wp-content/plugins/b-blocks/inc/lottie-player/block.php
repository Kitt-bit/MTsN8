<?php
class BBlocksLottiePlayer extends BBlocks{
	public function __construct(){
		add_action( 'init', [$this, 'onInit'] );
	}

	function onInit(){
		register_block_type( __DIR__, [
			'render_callback' => [$this, 'render']
		] ); // Register Block
	}

	function render( $attributes ){
		extract( $attributes );

		wp_enqueue_style( 'b-blocks-lottie-player-style' );
		wp_enqueue_script( 'b-blocks-lottie-player-script', B_BLOCKS_DIST . 'lottie-player.js', [ 'react', 'react-dom', 'dotLottiePlayer', 'lottieInteractivity' ], B_BLOCKS_VERSION, true );
		wp_set_script_translations( 'b-blocks-lottie-player-script', 'b-blocks', B_BLOCKS_DIR_PATH . 'languages' );

		$className = $className ?? '';
		$planClass = BBlocks\Inc\BBlocksUtils::isPro() ? 'pro' : 'free';
		$blockClassName = "wp-block-b-blocks-lottie-player $className $planClass align$align";

		ob_start(); ?>
		<div class='<?php echo esc_attr( $blockClassName ); ?>' id='bBlocksLottiePlayer-<?php echo esc_attr( $cId ); ?>' data-attributes='<?php echo esc_attr( wp_json_encode( $attributes ) ); ?>'></div>

		<?php return ob_get_clean();
	}
}
new BBlocksLottiePlayer();