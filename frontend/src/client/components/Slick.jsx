import React from 'react';
import Slider from 'react-slick';

require('../../../node_modules/slick-carousel/slick/slick.css');
require('../../../node_modules/slick-carousel/slick/slick-theme.css');

export default class Slick extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            settings: {
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false
            }
        }
    }

    render = () =>
        <Slider {...this.state.settings}>
            {this.props.children}
        </Slider>

}
