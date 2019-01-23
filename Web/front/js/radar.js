function showRadar(score, avg) {
    var myChart = echarts.init(document.getElementById("leida"));
    var year = new Date(score[0].month).getFullYear();
    var month = new Date(score[0].month).getMonth() + 1;
    var title = year + "年" + month + "月";

    option = {
        title: {
            text: title + '成绩'
        },
        tooltip: {},
        legend: {
            data: ['成绩', '平均值']
        },
        radar: {
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#999',
                    borderRadius: 5,
                    padding: [8, 10]
                }
            },
            indicator: [
                { name: '积极性', max: 5 },
                { name: '创新性', max: 5 },
                { name: '责任感', max: 5 },
                { name: '熟练度', max: 5 },
                { name: '实施性', max: 5 },
                { name: '完成度', max: 5 }
            ]
        },
        series: [{
            type: 'radar',
            data: [{
                    value: [
                        score[0].data1,
                        score[0].data2,
                        score[0].data3,
                        score[0].data4,
                        score[0].data5,
                        score[0].data6
                    ],
                    name: '成绩'
                },
                {
                    value: [
                        avg[0][0],
                        avg[0][1],
                        avg[0][2],
                        avg[0][3],
                        avg[0][4],
                        avg[0][5]
                    ],
                    name: '平均值'
                }
            ]
        }]
    };

    myChart.setOption(option);
}