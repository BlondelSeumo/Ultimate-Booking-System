jQuery(function($){
    $(document).ready(function () {
        var condition_object='select, input[type="radio"]:checked, input[type="text"], input[type="hidden"], input.ot-numeric-slider-hidden-input,input[type="checkbox"]';
        // condition function to show and hide sections
        $('.main-content').on( 'change.conditionals', condition_object, function(e) {
            run_condition_engine();
        });
        run_condition_engine();
        function run_condition_engine(){
            $('[data-condition]').each(function() {
                var passed;
                var conditions = get_match_condition( $( this ).data( 'condition' ) );
                var operator = ( $( this ).data( 'operator' ) || 'and' ).toLowerCase();

                $.each( conditions, function( index, condition ) {

                    var target   = $( '[name='+ condition.check+']' );

                    var targetEl = !! target.length && target.first();

                    if ( ! target.length || ( ! targetEl.length && condition.value.toString() != '' ) ) {
                        return;
                    }

                    var v1 = targetEl.length ? targetEl.val().toString() : '';
                    var v2 = condition.value.toString();

                    var result;

                    if(targetEl.length && targetEl.attr('type')=='radio'){
                        v1 = $( '[name='+ condition.check+']:checked').val();
                    }
                    if(targetEl.length && targetEl.attr('type')=='checkbox'){
                        v1=targetEl.is(':checked')?v1:'';
                    }

                    switch ( condition.rule ) {
                        case 'less_than':
                            result = ( parseInt( v1 ) < parseInt( v2 ) );
                            break;
                        case 'less_than_or_equal_to':
                            result = ( parseInt( v1 ) <= parseInt( v2 ) );
                            break;
                        case 'greater_than':
                            result = ( parseInt( v1 ) > parseInt( v2 ) );
                            break;
                        case 'greater_than_or_equal_to':
                            result = ( parseInt( v1 ) >= parseInt( v2 ) );
                            break;
                        case 'contains':
                            result = ( v1.indexOf(v2) !== -1 ? true : false );
                            break;
                        case 'is':
                            result = ( v1 == v2 );
                            break;
                        case 'not':
                            result = ( v1 != v2 );
                            break;
                    }

                    if ( 'undefined' == typeof passed ) {
                        passed = result;
                    }

                    switch ( operator ) {
                        case 'or':
                            passed = ( passed || result );
                            break;
                        case 'and':
                        default:
                            passed = ( passed && result );
                            break;
                    }

                });

                if ( passed ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }

                passed = undefined;
            });
        }

        function get_match_condition(condition){
            var match;
            var regex = /(.+?):(is|not|contains|less_than|less_than_or_equal_to|greater_than|greater_than_or_equal_to)\((.*?)\),?/g;
            var conditions = [];

            while( match = regex.exec( condition ) ) {
                conditions.push({
                    'check': match[1],
                    'rule':  match[2],
                    'value': match[3] || ''
                });
            }

            return conditions;
        }
        // Please do not edit condition section if you don't understand what it is

    });
});