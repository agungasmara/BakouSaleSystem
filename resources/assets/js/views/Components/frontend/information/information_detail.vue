<template>
	
<!-- /.Fixed navbar  -->
<div class="container main-container headerOffset">
    <div class="row">
        <div v-for="infor of StateData">
            <h1>{{infor.title}}</h1>
        	<p>{{infor.description}}</p>
            <!-- {{ $route.params.id }} -->
        </div>
        <p v-for="infor of informationInfo">{{infor.description}}</p>
    </div>
</div>
<!-- /main-container -->

<!-- <div class="gap"></div> -->
</template>

<script>
    import InformationDataComponent from './../../../Components/frontend/information/_information_data.vue'
    import Flash from '../../../../helper/flash'
    import axios from 'axios'

    export default{
        props:['id'],
        data(){
            return{
                StateData:Flash.state,
                // informationInfo:[],
            }
        },
        ready: function () {
            // alert("testig");
            // alert($route.params.id);
        },
        components:{
            InformationDataComponent
        },
        created(){
            this.helloworld="1";
            this.productDetails(this.id);
        },
        // beforeRouteEnter (to, from, next) {
        //     alert(to.params.id);
        //     // getPost(to.params.id, (err, post) => {
        //     //   next(vm => vm.setData(err, post))
        //     // })
        // },

        // beforeRouteUpdate (to, from, next) {
        //     var id = to.params.id;
        //     Flash.setState(this.productDetails(id));
        // },

        mounted() {
            this.$nextTick(function () {
                // alert("testing");
            });
        },
        // beforeRouteUpdate() {
        //     alert(this.$route.params.id);
        // //     alert(this.id);
        // //     // this.productInfo = Flash.setState(this.productDetails(this.id));
        // //     // alert("test");
        // //     // this.name = to.params.name
        // },
        methods:{
            productDetails(id){
                axios.get('/api/information/'+id).then(res=>{
                    this.StateData=res.data['data'];
                });
            }
        }
    }
</script>