<template>
	
<!-- /.Fixed navbar  -->
<div class="container main-container headerOffset">
    <div class="row">
        <h1>{{StateData.title}}</h1>
        <span v-html="StateData.description"></span>
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
        mounted(){
            
        },
        created(){
            this.productDetails(this.id)
        },
        beforeUpdate(){
            var pid = this.$route.params.id
            Flash.setState(this.productDetails(pid))
        },
        methods:{
            productDetails(id){
                axios.get('/api/information/'+id).then(res=>{
                    this.StateData=res.data
                });
            }
        }
    }
</script>