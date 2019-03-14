//Use JSON file about user's reviews and display in a chart

var url = "userchartdata";
        var Rating = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Rating.push(data.review_rating);
            });
              //find how many reviews are rated "0"
              var arrayToCount0 = Rating;
              var result0 = arrayToCount0.filter(i => i === 0).length;
              
              //find how many reviews are rated "1"
              var arrayToCount1 = Rating;
              var result1 = arrayToCount1.filter(i => i === 1).length;
              
              //find how many reviews are rated "2"
              var arrayToCount2 = Rating;
              var result2 = arrayToCount2.filter(i => i === 2).length;
              
              //find how many reviews are rated "3"
              var arrayToCount3 = Rating;
              var result3 = arrayToCount3.filter(i => i === 3).length;
              
              //find how many reviews are rated "4"
              var arrayToCount4 = Rating;
              var result4 = arrayToCount4.filter(i => i === 4).length;
              
              //find how many reviews are rated "5"
              var arrayToCount5 = Rating;
              var result5 = arrayToCount5.filter(i => i === 5).length;
              
            var ctx = document.getElementById("userReviewChart").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: 
                    {
                      labels:['0/5 Rated', '1/5 Rated', '2/5 Rated', '3/5 Rated', '4/5 Rated', '5/5 Rated'],
                      datasets: 
                      [{
                          label: 'No. of reviews per rating',
                          data: [result0, result1, result2, result3, result4, result5],
                          backgroundColor: [
                            '#ff0000',
                            '#ff0000',
                            '#ff4500',
                            '#ff8c00',
                            '#c0ff33',
                            '#66cc33',
                          ],
                      }]
                    },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fixedStepSize: 5,
                                suggestedMin: 0,
                            }
                        }]
                    }
                }
              });
          });
        });