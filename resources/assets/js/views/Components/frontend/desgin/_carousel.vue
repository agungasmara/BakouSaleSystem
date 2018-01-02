 <template>
   <div class="width100 section-block">

     <!--  <li v-for="showBrand of data['brands']">
        <span v-for="b of showBrand['BannerImageArray']">
          {{b.image}}
        </span>
      </li> -->

        <h3 class="section-title"><span> BRAND</span> <a id="nextBrand" class="link pull-right carousel-nav"> <i class="fa fa-angle-right"></i></a> <a id="prevBrand" class="link pull-right carousel-nav"> <i
                class="fa fa-angle-left"></i> </a></h3>

        <div class="row">
            <div class="col-lg-12">
                <ul class="no-margin brand-carousel owl-carousel owl-theme">
                    <!-- <span v-for="showBrand of data['brands']">
                      <li v-for="b of showBrand['BannerImageArray']">
                        <a><img v-bind:src="b.image" alt="img"></a>
                      </li>
                    </span> -->
                    <li v-for="b of data['BannerImageArray']">
                      <img src="/assets/frontend/images/brand/2.png" alt="img"/>
                    </li>
                    <li><img src="/assets/frontend/images/brand/0.png" alt="img" style="display: none;"></li>
                    <!-- <li><img src="/assets/frontend/images/brand/4.png" alt="img"></li> -->
                    <!-- <li><img src="/assets/frontend/images/brand/5.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/6.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/7.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/8.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/1.gif" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/2.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/3.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/4.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/5.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/6.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/7.png" alt="img"></li>
                    <li><img src="/assets/frontend/images/brand/8.png" alt="img"></li> -->
                </ul>
            </div>
        </div>
        <!--/.row-->
    </div>
 </template>


<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'

    export default {
        data() {
            return {
                flash: Flash.state,
                error: Flash.state,
                error: {},
                data: [],
            }
        },
        mounted: function(){
          // alert("test");
          $.getScript('http://localhost:8000/assets/frontend/js/owl.carousel.min.js');
        },
        created() {
          axios.get(`/api/banner`)
          .then(response => {
            this.data = response.data['brands'][0];
            console.log(response.data['brands'][0]);
          })
          .catch(e => {
            this.errors.push(e)
          })
        }
    }
</script>
