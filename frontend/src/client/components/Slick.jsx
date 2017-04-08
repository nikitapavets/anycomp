import React from 'react';
import Slider from 'react-slick';

require('../../../node_modules/slick-carousel/slick/slick.css');
require('../../../node_modules/slick-carousel/slick/slick-theme.css');

export default class Slick extends React.Component {
    constructor(props) {
        super(props);
    }

    render = () =>
        <Slider {...this.props.settings}>
            {this.props.checkEmpty ? this.props.children.length ? this.props.children : <div></div> : this.props.children}
        </Slider>

}
