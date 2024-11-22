// typical import
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

gsap.from('.fade-in-left',
{
    scrollTrigger: {
        trigger : '.fade-in-left',
        start: '20px 60%',
        end: '+=50%',
        //toggleActions:'reverse pause reverse pause',
        scrub: true,
        markers: false,
        //onEnter:() => console.log("enter")
    },
    x:100,
    opacity:0,
    duration:3
    // stagger:0.1,
});

gsap.from('.fade-in-right',
{
    scrollTrigger: {
        trigger : '.fade-in-right',
        start: '20px 60%',
        end: '+=50%',
        //toggleActions:'reverse pause reverse pause',
        scrub: true,
        markers: false,
        //onEnter:() => console.log("enter")
    },
    x:-100,
    opacity:0,
    duration:3
    // stagger:0.1,
});