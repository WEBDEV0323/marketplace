<section
											class="elementor-element elementor-element-b240d07 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
											data-id="b240d07" data-element_type="section">
											<div class="elementor-container elementor-column-gap-default">
												<div class="elementor-row">
													<div class="elementor-element elementor-element-ddaefc5 elementor-column elementor-col-100 elementor-top-column"
														data-id="ddaefc5" data-element_type="column">
														<div class="elementor-column-wrap  elementor-element-populated">
															<div class="elementor-widget-wrap">
																<div class="elementor-element elementor-element-cacc863 elementor-widget elementor-widget-kite-ajax-woocommerce-products"
																	data-id="cacc863" data-element_type="widget"
																	data-widget_type="kite-ajax-woocommerce-products.default">
																	<div class="elementor-widget-container">
																		<div id=ajax_products_tab_1
																			class="vc_tta-container ajax_products_tab">
																			<div
																				class="vc_general vc_tta vc_tta-tabs vc_tta-style-dark vc_tta-tabs-position-top vc_tta-o-shape-group vc_tta-shape-left vc_tta-controls-align-left">
																				<div class="vc_tta-tabs-container">
																					<ul class="vc_tta-tabs-list">
																						<li class='vc_tta-tab vc_active'
																							data-shortcode-prop='{"tab_title":"MEN'
																							S NEW
																							IN","tab_icon_check":"disable","product_type":"featured","per_page":"6","columns":"5","order":"DESC","layout_mode":"","carousel":"enable","is_autoplay":"on","nav_style":"light","border":"","quickview":"","wishlist":"","compare":"","badges":"","hover_price":"disable","hover_color":"custom-color","list_style":"","column_in_mobile":"","tablet_columns":""}'
																							data-tab-id='0'><a><span
																									class="vc_tta-title-text">MEN'S
																									NEW IN</span></a>
																						</li>
																					</ul>
																				</div>
																				<div class="vc_tta-panels-container">
																					<div class="vc_tta-panels" style="">
																						<span
																							class="wc-loading hide"></span>
																						<div class="vc_tta-panel vc_active_show show vc_active"
																							data-tab-id="0">
																							<div class="woocommerce wc-shortcode  fadein 1 carousel no-responsive-animation light"
																								data-layoutMode=""
																								data-autoplay="on"
																								data-delay="0"
																								data-animation="none">

																								<div
																									class="products buttonsonhover shop-5column">

																									<div class="swiper-container"
																										data-visibleitems="5">
																										<div
																									class="swiper-wrapper">
																											
																										@forelse($products as $key=>$product)
                                                                                                        	<div
																												class="has-gallery product type-product post-719 status-publish first instock product_cat-uncategorized product_tag-sneakers has-post-thumbnail sale featured shipping-taxable purchasable product-type-simple">
																												<div
																													class="productwrap">
																													<span
																														class="onsale percentage-sale">-46%</span>
																													<span
																														class="added_to_cart_icon icon icon-check"></span>
																													<div
																														class="add_to_cart_btn_wrap lazy-load-hover-container">



																														<a href="{{route('single-product',[$product['id']])}}"
																															class="product-link"></a>
																														<div class="imageswrap productthumbnail lazy-load lazy-load-on-load"
																															style="padding-top: 100%;">
																															<img src="{{$product['image_url']}}"
																																width="800"
																																height="800"
																																data-src="{{$product['image_url']}}"
																																alt="Untitled-8" />
																														</div>
																														<div class="hover-image lazy-load lazy-load-hover bg-lazy-load"
																															data-src="{{$product['image_url']}}">
																														</div>
																														<div
																															class="product-buttons ">

																															<span
																																class="product-button product_type_simple"><a
																																	href="index54f3.html?add-to-cart=719"
																																	rel="nofollow"
																																	data-product_id="719"
																																	data-product_sku="96584"
																																	data-quantity="1"
																																	class="button add_to_cart_button product_type_simple ajax_add_to_cart"><span
																																		class="icon"></span><span
																																		class="txt"
																																		data-hover="Add to cart">Add
																																		to
																																		cart</span></a></span><span
																																title="Add to compare list"><a
																																	href="http://digitalech.com/mplace?action=yith-woocompare-add-product&amp;id=719"
																																	class="no_djax compare button"
																																	data-product_id="719"
																																	rel="nofollow">Compare</a></span><span><a
																																	href="indexbb38.html?add_to_wishlist=719"
																																	rel="nofollow"
																																	data-product-id="719"
																																	data-product-type="simple"
																																	class="add_to_wishlist shop_wishlist_button "
																																	title="Add to wishlist"><span
																																		class="wc-loading hide"></span></a><a
																																	href="wishlist/index.html"
																																	rel="nofollow"
																																	class="wishlist-link shop_wishlist_button"
																																	style=""
																																	title="Go to wishlist"></a></span>
																														</div>

																													</div>

																													<div
																														class="wrap_after_thumbnail">

																														
																														<span
																															class="default_product_cat">
																															@foreach($product['prod_shop_cat'] as $cat_name)
																															<a
																																href='product-category/uncategorized/index.html'
																																class='cat_link'>
																																	
																																	{{$cat_name['shop_cat']['shop_cat_name']}}
																																	
																																
																																</a>
																																@endforeach
																																</span>
																																<a
																															href="product/sneakers-7/index.html">
																															<h2
																																class="woocommerce-loop-product__title">
																																{{$product['product_name']}}
																															</h2>
																														</a>
																														<span
																															class="price"><del><span
																																	class="woocommerce-Price-amount amount"><span
																																		class="woocommerce-Price-currencySymbol">&pound;</span>{{$product['regular_price']}}</span></del>
																															<ins><span
																																	class="woocommerce-Price-amount amount"><span
																																		class="woocommerce-Price-currencySymbol">&pound;</span>{{$product['sale_price']}}</span></ins></span>

																													</div>
																												</div>
																											</div>
                                                                                                            
                                                                                                            @empty
                                                                                                            <p>No Products</p>
																									@endforelse	
                                                                                                    </div>
																									</div>

																									<div
																										class="arrows-button-next">
																									</div>
																									<div
																										class="arrows-button-prev">
																									</div>

																								</div>


																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>