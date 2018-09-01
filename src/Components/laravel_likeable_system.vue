<template>
    <div>
        <div v-if="auth" class="lgs_float_right text_align_right">
            <i class="lls-icon fa-lls-thumbs-up1 color_green pointer" @click="changeLike('like')" :class="{bold:isActiveLike}">{{like}}</i>
            <i class="lls-icon fa-lls-thumbs-down1 color_red pointer" @click="changeLike('disLike')" :class="{bold:isActiveDislike}">{{dis_like}}</i>
        </div>
        <div v-else class="lgs_float_right lgs_text_left">
            <i class="lls-icon fa-lls-thumbs-up color_gray ">{{like}}</i>
            <i class="lls-icon fa-lls-thumbs-down1 color_gray">{{dis_like}}</i>
        </div>
    </div>
</template>
<script>
    import axios from './lib/axios/index.js'

    export default {
        name: "laravel_likeable_system",
        props: ['model', 'item', 'type','auth'],
        data: function () {
            return {
                isActiveLike:false,
                isActiveDislike:false,
                like :this.item.likes_count,
                dis_like:this.item.dis_likes_count,
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
        }
    }
</script>

<style scoped>
    @import  './lib/icon/style.css';
    .color_green {
        color:#27ae60;
    }
    .color_red{
        color:red;
    }
    .color_gray{
        color: #808080;
    }
    .bold {
        font-weight: bold;
    }

</style>