<template>
    <div class="float-right" v-if="canVote">
        <i class="far fa-thumbs-up color_green pointer" @click="changeLike('like')" :class="{bold:isActiveLike}">{{like}}</i>
        <i class="far fa-thumbs-down color_red pointer" @click="changeLike('disLike')" :class="{bold:isActiveDislike}">{{dis_like}}</i>
    </div>
    <div class="float-right" v-else>
        <i v-if="type ==='like'" class="far fa-thumbs-up color_gray ">{{like}}</i>
        <i v-else-if="type ==='disLike'" class="far fa-thumbs-down color_gray">{{dis_like}}</i>
        <i v-else></i>
    </div>
</template>

<script>
    import axios from '../../../../../public/vendor/laravel_gallery_system/packages/axios/index.js'

    export default {
        name: "laravel_likeable_system",
        props: ['model', 'item', 'type'],
        data: function () {
            return {
                canVote:true,
                isActiveLike:false,
                isActiveDislike:false,
                like :this.item.likes.length,
                dis_like:this.item.dis_likes.length
            }
        },
        computed: {
        },
        methods: {
            changeLike: function (type) {
                axios.post("/LLS/chnageLike", {encode_id: this.item.encode_id, model: this.model, type: type,isActiveLike:this.isActiveLike,isActiveDislike:this.isActiveDislike}).then(response => {
                    this.$nextTick(() => {
                        if (response.data.success) {
                            if (type == 'like')
                            {
                                if(this.isActiveLike)
                                {
                                   this.like --;
                                }
                                else
                                {
                                    if(this.isActiveDislike)
                                    {
                                       this.like ++ ;
                                       this.dis_like -- ;
                                        this.isActiveDislike = false;
                                    }
                                    else
                                    {
                                        this.like ++;
                                    }
                                }
                                this.isActiveLike = !this.isActiveLike;
                            }
                            else if (type == 'disLike') {
                                if (this.isActiveDislike)
                                {
                                    this.dis_like -- ;
                                }
                                else
                                {
                                    if (this.isActiveLike)
                                    {
                                        this.dis_like ++ ;
                                        this.like --;
                                        this.isActiveLike = false;

                                    }
                                    else
                                    {
                                        this.dis_like ++ ;
                                    }
                                }

                                this.isActiveDislike = !this.isActiveDislike;
                            }
                            else {
                                console.log('you should chose type equal like or disLkie');
                            }
                        }
                        else
                        {
                            console.log(response.data);
                        }
                    })
                })
            },

            setVote:function () {

            }
        }
    }
</script>

<style scoped>
    .color_green {
        color:#27ae60;
    }
    .color_red{
        color:red;
    }
    .float-right{
        float:left!important;
    }
    .color_gray{
        color: #808080;
    }
    .bold {
        font-weight: bold;
    }

</style>