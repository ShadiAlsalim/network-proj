import './bootstrap';

const channel = Echo.channel('public.test.1');
channel.subscribed(()=>{
    console.log('done..');
});