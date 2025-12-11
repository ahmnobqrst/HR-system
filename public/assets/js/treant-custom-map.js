var config = {
    container: "#custom-colored",
    levelSeparation: 60,
    rootOrientation: "WEST",
    nodeAlign: "BOTTOM",
    padding: 70,
    scrollbar: "fancy",
    // animateOnInit: true,
    
    connectors: {
        type: 'bCurve',
        style: {
            "stroke-width": 2,
            'stroke': '#2bc3d2',
            'arrow-end': 'block-wide-long',
            "stroke-dasharray": "-",
            // 'arrow-start': 'classic-wide-long'
        }
    },
    node: {
        HTMLclass: 'nodeExample1 zoom',
        // rawLineThrough: true,
        // collapsable: true
    },
    // animation: {
    //     nodeAnimation: "easeOutBounce",
    //     nodeSpeed: 700,
    //     connectorsAnimation: "bounce",
    //     connectorsSpeed: 700
    // },
    // collapsed: true
},
ceo = {
    text: {
        name: "Raising Employee Performance",
        title: "Start: 07-2023 ==> End: 08-2028",
        desc: "Customers",
        // data: " data Attribute for node",
        // data2: " data Attribute for nodeGGG",
        // contact: { 
        //     val: "contact me",
        //     href: "kpi-value.html",
        //     target: "_self"
        // },
    }
},

cto = {
    parent: ceo,
    HTMLclass: 'light-gray',
    text:{
        name: "Raise salaries",
        title: "Start: 10-2023 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
cbo = {
    parent: ceo,
    childrenDropLevel: 0,
    HTMLclass: 'blue',
    text:{
        name: "Development Courses",
        title: "Start: 08-2023 ==> End: 10-2024",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
cdo = {
    parent: ceo,
    HTMLclass: 'gray',
    text:{
        name: "Leisure trips",
        title: "Start: 08-2023 ==> End: 10-2028",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
cio = {
    parent: cto,
    HTMLclass: 'light-gray',
    text:{
        name: "Increase by 2%",
        title: "Start: 11-2023 ==> End: 12-2025",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
ciso = {
    parent: cto,
    HTMLclass: 'light-gray',
    text:{
        name: "Increase by 5%",
        title: "Start: 12-2025 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
cio2 = {
    parent: cdo,
    HTMLclass: 'gray',
    text:{
        name: "Eiffel tower",
        title: "Start: 12-2025 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    },
    // link: {
    //     href: "http://www.google.com"
    // }
},
ciso2 = {
    parent: cbo,
    HTMLclass: 'blue',
    text:{
        name: "UI & UX Design",
        title: "Start: 12-2025 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
ciso3 = {
    parent: cbo,
    HTMLclass: 'blue',
    text:{
        name: "Front End Mastery",
        title: "Start: 12-2025 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},
ciso4 = {
    parent: cbo,
    HTMLclass: 'blue',
    text:{
        name: "TypeScript",
        title: "Start: 12-2025 ==> End: 10-2027",
        contact: { 
            val: "See More..",
            href: "kpi-value.html",
            target: "_self"
        },
    }
},

chart_config = [
    config,
    ceo,cto,cbo,
    cdo,cio,ciso,
    cio2,ciso2,ciso3,ciso4
];

new Treant( chart_config );

