(function ($, root, undefined) {
	$(function () {
		'use strict';

        // Review total score update
        function updateTotalScore(){
            $('#md_bone_post_options #criteria_score').closest('.rwmb-group-wrapper').on('click mousedown keydown', function(){
                var totalScore = 0;
                var i = 0;
                var scores = [];
                var $mdReviewScores = $(this).find('[name^=md_bone_review_score][name*=criteria_score]');
                $mdReviewScores.each(function(){
                    scores.push($(this).val());
                    totalScore += parseInt($(this).val());
                    i++;
                });
                if (scores.length > 0) {
                    $('#md_bone_review_totalscore').val(Math.round((totalScore/scores.length)*10)/10);
                }
            });
        }

        $(document).ready(function() {
            updateTotalScore();
        });
	});
})(jQuery, this);