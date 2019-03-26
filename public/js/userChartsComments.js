//Use JSON file about user's comments and display in a chart
var commentsurl = "commentsjson";
var Comment = new Array();
$(document).ready(function()
{
    $.get(commentsurl, function(comments)
          {
            comments.forEach(function(data)
            {
                Comment.push(data.id);
            });
        
var commentLength = Comment.length;

var ctx = document.getElementById("userCommentChart").getContext('2d');
var myChart = new Chart(ctx, 
{
    type: 'bar',
    data: 
    {
        labels:['This Week\'s Comments'],
        datasets: 
        [{
            label: 'No. of comments this week',
            data: [commentLength],
            backgroundColor: 
            [
                '#66cc33',
            ],
        }]
    },
    options: 
    {
        scales: 
        {
            xAxes:
            [{
                barPercentage: 0.4,
            }],
            yAxes: 
            [{
                ticks: 
                {
                    fixedStepSize: 3,
                    suggestedMin: 0,
                }
            }]
        }
    }
});
});
});    