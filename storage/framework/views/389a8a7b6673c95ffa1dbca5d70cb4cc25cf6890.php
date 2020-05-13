<div class="bravo_tour_book_wrap">
    <div class="bravo_tour_book">
        <div id="bravo_tour_book_app" v-cloak>
            <?php if($row->discount_percent): ?>
                <div class="tour-sale-box">
                    <span class="sale_class box_sale sale_small"><?php echo e($row->discount_percent); ?></span>
                </div>
            <?php endif; ?>
            <div class="form-head">
                <div class="price">
                    <span class="label">
                        <?php echo e(__("from")); ?>

                    </span>
                    <span class="value">
                        <span class="onsale"><?php echo e($row->display_sale_price); ?></span>
                        <span class="text-lg"><?php echo e($row->display_price); ?></span>
                    </span>
                </div>
            </div>
            <div class="form-content">
                <div class="form-group form-date-field form-date-search clearfix " data-format="<?php echo e(get_moment_date_format()); ?>">
                    <div class="date-wrapper clearfix" @click="openStartDate">
                        <div class="check-in-wrapper">
                            <label><?php echo e(__("Start Date")); ?></label>
                            <div class="render check-in-render">{{start_date_html}}</div>
                        </div>
                        <i class="fa fa-angle-down arrow"></i>
                    </div>
                    <input type="text" class="start_date" ref="start_date" style="height: 1px; visibility: hidden">
                </div>
                <div class="" v-if="person_types">
                    <div class="form-group form-guest-search" v-for="(type,index) in person_types">
                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label>{{type.name}}</label>
                                <div class="render check-in-render">{{type.desc}}</div>
                                <div class="render check-in-render">{{type.display_price}} <?php echo e(__("per people")); ?></div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <i class="icon ion-ios-remove-circle-outline" @click="minusPersonType(type)"></i>
                                    
                                    <span class="input">{{type.number}}</span>
                                    <i class="icon ion-ios-add-circle-outline" @click="addPersonType(type)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-guest-search" v-else>
                    <div class="guest-wrapper d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <label><?php echo e(__("Guests")); ?></label>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="input-number-group">
                                <i class="icon ion-ios-remove-circle-outline"></i>
                                <span class="input">{{guests}}</span>
                                <i class="icon ion-ios-add-circle-outline"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section-group" v-if="extra_price.length">
                    <h4 class="form-section-title"><?php echo e(__('Extra prices:')); ?></h4>
                    <div class="form-group " v-for="(type,index) in extra_price">
                        <div class="extra-price-wrap d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <label><input type="checkbox" v-model="type.enable"> {{type.name}}</label>
                                <div class="render" v-if="type.price_type">({{type.price_type}})</div>
                            </div>
                            <div class="flex-shrink-0">{{type.price_html}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-html="html"></div>
            <div class="submit-group">
                <a class="btn btn-large" @click="doSubmit($event)" :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}" name="submit">
                    <span v-if="step == 1"><?php echo e(__("BOOK NOW")); ?></span>
                    <span v-if="step == 2"><?php echo e(__("Book Now")); ?></span>
                    <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                </a>
                <div class="alert-text mt10" v-show="message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/details/tour-form-book.blade.php ENDPATH**/ ?>